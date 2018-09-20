<?php

namespace App\Http\Controllers;

use App\Administrativo;
use App\Empleado;
use App\Http\Requests\AdministrativoRequest;
use App\Http\Requests\BusquedaRequest;
use App\Role;
use App\TipoEmpleado;
use App\User;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Estado;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministrativoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:administrativos.index')->only(['index']);
        $this->middleware('has.permission:administrativos.show')->only(['show']);
        $this->middleware('has.permission:administrativos.create')->only(['create', 'store']);
        $this->middleware('has.permission:administrativos.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $administrativos = Administrativo::query()
                                        ->documento($request->docu_admi)
                                        ->nombre($request->nomb_admi)
                                        ->primerApellido($request->pape_admi)
                                        ->cargo($request->carg_admi)
                                        ->autenticado()
                                        ->orderBy('nomb_admi')
                                        ->orderBy('pape_admi')
                                        ->orderBy('docu_admi')
                                        ->paginate();

        return view('administrativos.index', compact('administrativos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoEmpleados = TipoEmpleado::query()
                                    ->select('id', 'nomb_tipo')
                                    ->orderBy('nomb_tipo')
                                    ->get();

        return view('administrativos.create', compact('tipoEmpleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdministrativoRequest $request)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            /**
             * Registrar el usuario
             */
            $usuario = User::create([
                'nombre' => trim("{$request->nomb_admi} {$request->pape_admi} {$request->sape_admi}"),
                'email' => $request->corr_admi,
                'password' => bcrypt($request->docu_admi),
                'estado' => Estado::activo(),
            ]);

            /**
             * Obtener el rol del administrativo
             */
            $role = $this->getRoleValue($request->carg_admi);

            /**
             * Asignar rol al usuario
             */
            $usuario->syncRoles([$role]);

            /**
             * Registrar el empleado
             */
            $empleado = Empleado::create($request->only('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            /**
             * Registrar el administrativo
             */
            $request->merge([
                'empleado_id' => $empleado->id,
                'user_id' => $usuario->id,
            ]);

            $administrativo = Administrativo::create($request->except('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            DB::commit();

            toast('¡El administrativo ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('administrativos.show', $administrativo->id);

        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el administrativo!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el administrativo!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrativo  $administrativo
     * @return \Illuminate\Http\Response
     */
    public function show(Administrativo $administrativo)
    {
        $administrativo->loadMissing('empleado.tipoEmpleado');

        return view('administrativos.show', compact('administrativo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrativo  $administrativo
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrativo $administrativo)
    {
        $tipoEmpleados = TipoEmpleado::query()
                                    ->select('id', 'nomb_tipo')
                                    ->orderBy('nomb_tipo')
                                    ->get();

        $administrativo->loadMissing('empleado.tipoEmpleado');

        return view('administrativos.edit', compact('administrativo', 'tipoEmpleados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrativo  $administrativo
     * @return \Illuminate\Http\Response
     */
    public function update(AdministrativoRequest $request, Administrativo $administrativo)
    {
        $request->validate();

        if ($administrativo->noPuedeCambiarCargoJornada())
        {
            if ($administrativo->jorn_admi !== $request->jorn_admi)
            {
                toast('¡No es posible cambiar su jornada adulterando la misma!', 'error', 'top-right');

                return redirect()->back()->withInput();
            }
            else if ($administrativo->carg_admi !== $request->carg_admi)
            {
                toast('¡No es posible cambiar su jornada adulterando la misma!', 'error', 'top-right');

                return redirect()->back()->withInput();
            }
        }

        DB::beginTransaction();

        try
        {
            /**
             * Actualizar el usuario
             */
            $administrativo->user->update([
                'nombre' => trim("{$request->nomb_admi} {$request->pape_admi} {$request->sape_admi}"),
                'email' => $request->corr_admi,
            ]);

            /**
             * Actualizar rol de usuario si el cargo ha cambiado
             */
            if ($administrativo->carg_admi !== $request->carg_admi)
            {
                $role = $this->getRoleValue($request->carg_admi);

                /**
                 * Asignar rol al usuario
                 */
                $administrativo->user->syncRoles([$role]);
            }

            /**
             * Actualizar el empleado
             */
            $administrativo->empleado->update($request->only('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            /**
             * Actualizar el administrativo
             */
            $administrativo->update($request->except('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            DB::commit();

            toast('¡El administrativo ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('administrativos.show', $administrativo->id);

        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el administrativo!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el administrativo!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrativo  $administrativo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrativo $administrativo)
    {
        //
    }

    /**
     * Obtiene el id del rol seleccionado.
     *
     * @param  string  $cargo
     * @return string
     */
    protected function getRoleValue($cargo)
    {
        switch ($cargo)
        {
            case Cargo::administrador():
                $slug = SpecialRole::administrador();
                break;

            case Cargo::coordinador():
                $slug = SpecialRole::coordinador();
                break;

            case Cargo::secretaria():
                $slug = SpecialRole::secretaria();
                break;

            default:
                $slug = null;
                break;
        }

        return Role::where('slug', $slug)->value('id');
    }
}
