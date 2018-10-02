<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\UsuarioRequest;
use App\Role;
use App\Scopes\RoleScope;
use App\User;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Estado;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:usuarios.index')->only(['index']);
        $this->middleware('has.permission:usuarios.show')->only(['show']);
        $this->middleware('has.permission:usuarios.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $roles = Role::query()
                    ->orderBy('name')
                    ->get();

        $usuarios = User::query()
                    ->with('roles')
                    ->nombre($request->nombre)
                    ->estado($request->estado)
                    ->rol($request->rol)
                    ->autenticado()
                    ->orderBy('nombre')
                    ->orderByDesc('estado')
                    ->paginate();

        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        /*if ($usuario->esAcudiente()) {
            $usuario->loadMissing('acudiente');
        }
        if ($usuario->esAdministrativo()) {
            $usuario->loadMissing('administrativo');
        }
        if ($usuario->esDocente()) {
            $usuario->loadMissing('docente');
        }
        if ($usuario->esEstudiante()) {
            $usuario->loadMissing('estudiante');
        }*/

        $usuario->loadMissing('roles.permissions');

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $roles = Role::query()
                    ->whereNotIn('slug', [
                        SpecialRole::docente(), SpecialRole::estudiante(), SpecialRole::acudiente()
                    ])
                    ->whereNull('special')
                    ->orWhere('special', SpecialRole::allAccess())
                    ->orderBy('name')
                    ->get();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, User $usuario)
    {
        $request->validate();

        if ($usuario->noPuedeCambiarSuEstado())
        {
            toast('¡No es posible cambiar su estado, seria revocado su acceso al sistema!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        else if ($usuario->noPuedeCambiarRol() && $usuario->getRolId() !== $request->role)
        {
            toast('¡No es posible cambiar su rol adulterando el mismo!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }

        DB::beginTransaction();

        try
        {
            /**
             * Actualizar el usuario
             */
            $usuario->estado = $request->estado;

            if ($request->filled('password'))
            {
                $usuario->password = bcrypt($request->password);
            }

            if ($usuario->isDirty())
            {
                $usuario->save();
            }

            /**
             * Actualizar el rol al usuario
             */
            if ($usuario->puedeCambiarRol() && $usuario->getRolId() !== $request->role)
            {
                $usuario->syncRoles([$request->role]);

                /**
                 * Actualizar el cargo del usuario de acuerdo al rol si el cargo resultantes es diferente de null.
                 */
                $usuario->loadMissing('administrativo');

                $cargo = $this->getCargoValue(Role::findOrFail($request->role)->id);

                if ($usuario->esAdministrativo() && !is_null($usuario->administrativo) && !is_null($cargo))
                {
                    $usuario->administrativo->carg_admi = $cargo;
                    $usuario->administrativo->save();
                }
            }

            DB::commit();

            toast('¡El usuario ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('usuarios.index');
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el usuario!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el usuario!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Obtiene el id del cargo de acuerdo al slug del rol seleccionado.
     *
     * @param  string  $slug
     * @return string
     */
    protected function getCargoValue($slug)
    {
        switch ($slug)
        {
            case SpecialRole::administrador():
                $cargo = Cargo::administrador();
                break;

            case SpecialRole::coordinador():
                $cargo = Cargo::coordinador();
                break;

            case SpecialRole::secretaria():
                $cargo = Cargo::secretaria();
                break;

            default:
                $cargo = null;
                break;
        }

        return $cargo;
    }

}
