<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Http\Requests\AlumnoRequest;
use App\Http\Requests\BusquedaRequest;
use App\Programa;
use Facades\App\Facades\Documento;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\Sexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:alumnos.index')->only(['index']);
        $this->middleware('has.permission:alumnos.show')->only(['show']);
        $this->middleware('has.permission:alumnos.create')->only(['create', 'store']);
        $this->middleware('has.permission:alumnos.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:alumnos.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $alumnos = Alumno::query()
                        ->documento($request->docu_alum)
                        ->nombre($request->nomb_alum)
                        ->primerApellido($request->pape_alum)
                        ->acudiente($request->nomb_acud)
                        ->orderBy('nomb_alum')
                        ->orderBy('pape_alum')
                        ->orderBy('sape_alum')
                        ->paginate();

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programas = Programa::query()
                            ->orderBy('nomb_prog')
                            ->get();

        return view('alumnos.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            $alumno = Alumno::create($request->all());

            if ($request->filled('programas'))
            {
                $alumno->programas()->sync($request->get('programas'));
            }

            DB::commit();

            toast('¡El alumno ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('alumnos.show', $alumno->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el alumno!', 'success', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el alumno!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        $alumno->loadMissing('programas');

        return  view ('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        $alumno->loadMissing('programas');

        $programas = Programa::query()
                            ->orderBy('nomb_prog')
                            ->get();

        return  view ('alumnos.edit', compact('alumno', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoRequest $request, Alumno $alumno)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            $alumno->update($request->all());

            if ($request->filled('programas'))
            {
                $alumno->programas()->sync($request->get('programas'));
            }
            else
            {
                $alumno->programas()->detach();
            }

            DB::commit();

            toast('¡El alumno ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('alumnos.show', $alumno->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el alumno!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el alumno!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        try
        {
            $alumno->delete();

            toast('¡El alumno ha sido eliminado correctamente!', 'success', 'top-right');

            return redirect()->route('alumnos.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar el alumno!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
