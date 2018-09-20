<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Empleado;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\DocenteRequest;
use App\Role;
use App\TipoEmpleado;
use App\User;
use Facades\App\Facades\Estado;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:docentes.index')->only(['index']);
        $this->middleware('has.permission:docentes.show')->only(['show']);
        $this->middleware('has.permission:docentes.create')->only(['create', 'store']);
        $this->middleware('has.permission:docentes.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $docentes = Docente::query()
                            ->documento($request->docu_doce)
                            ->nombre($request->nomb_doce)
                            ->primerApellido($request->pape_doce)
                            ->segundoApellido($request->sape_doce)
                            ->autenticado()
                            ->orderBy('nomb_doce')
                            ->orderBy('pape_doce')
                            ->orderBy('sape_doce')
                            ->paginate();

        return view('docentes.index', compact('docentes'));
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

        return view('docentes.create', compact('tipoEmpleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocenteRequest $request)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            /**
             * Registrar el usuario
             */
            $usuario = User::create([
                'nombre' => trim("{$request->nomb_doce} {$request->pape_doce} {$request->sape_doce}"),
                'email' => $request->corr_doce,
                'password' => bcrypt($request->docu_doce),
                'estado' => Estado::activo(),
            ]);

            /**
             * Obtener el rol docente
             */
            $role = Role::where('slug', SpecialRole::docente())->value('id');

            /**
             * Asignar rol al usuario
             */
            $usuario->syncRoles([$role]);

            /**
             * Registrar el empleado
             */
            $empleado = Empleado::create($request->only('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            /**
             * Registrar el docente
             */
            $request->merge([
                'empleado_id' => $empleado->id,
                'user_id' => $usuario->id,
            ]);

            $docente = Docente::create($request->except('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            DB::commit();

            toast('¡El docente ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('docentes.show', $docente->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el docente!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el docente!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        $docente->loadMissing('empleado.tipoEmpleado');

        return view('docentes.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        $tipoEmpleados = TipoEmpleado::query()
                                    ->select('id', 'nomb_tipo')
                                    ->orderBy('nomb_tipo')
                                    ->get();

        $docente->loadMissing('empleado.tipoEmpleado');

        return view('docentes.edit', compact('docente', 'tipoEmpleados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(DocenteRequest $request, Docente $docente)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            /**
             * Actualizar el usuario
             */
            $docente->user->update([
                'nombre' => trim("{$request->nomb_doce} {$request->pape_doce} {$request->sape_doce}"),
                'email' => $request->corr_doce,
            ]);

            /**
             * Actualizar el empleado
             */
            $docente->empleado->update($request->only('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            /**
             * Actualizar el docente
             */
            $docente->update($request->except('fech_ingr', 'obse_empl', 'tipo_empleado_id'));

            DB::commit();

            toast('¡El docente ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('docentes.show', $docente->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el docente!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el docente!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

}
