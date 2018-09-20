<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Area;
use App\Docente;
use App\Grado;
use App\Subgrado;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\AsignaturaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignaturaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:asignaturas.index')->only(['index']);
        $this->middleware('has.permission:asignaturas.create')->only(['create', 'store']);
        $this->middleware('has.permission:asignaturas.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $areas = Area::query()
                    ->select('id', 'nomb_area')
                    ->orderBy('nomb_area')
                    ->get();

        $grados = Grado::query()
                        ->orderBy('abre_grad')
                        ->orderBy('nomb_grad')
                        ->get();

        $asignaturas = Asignatura::query()
                                ->nombre($request->nomb_asig)
                                ->area($request->area_id)
                                ->grado($request->grado_id)
                                ->orderBy('nomb_asig')
                                ->orderBy('area_id')
                                ->paginate();

        return view('asignaturas.index' , compact('asignaturas', 'areas', 'grados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = Docente::queryDocentes();

        $grados = Grado::all();

        $areas = Area::all();

        return view('asignaturas.create',compact('areas','docentes','grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsignaturaRequest $request)
    {

         $request->validate();

        try
        {
            $asignatura = Asignatura::create($request->all());

            toast('¡La Asignatura ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('asignaturas.show', $asignatura->id);
        }
        catch (\Exception $e)
        {

            toast('¡Se ha producido un error al registrar la Asignatura!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura)
    {
         return view('asignaturas.show',compact('asignatura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignatura $asignatura)
    {
         $docentes = Docente::queryDocentes();

        $grados = Grado::all();

        $areas = Area::all();

        return view('asignaturas.edit',compact('asignatura','areas','docentes','grados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function update(AsignaturaRequest $request, Asignatura $asignatura)
    {
        $request->validate();
        try
        {
            $asignatura->update($request->all());

            toast('¡La asignatura ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('asignaturas.show', $asignatura->id);
        }

        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar la asignatura!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

}
