<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Grado;
use App\Http\Requests\BusquedaRequest;
use App\Nota;
use App\SubGrado;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('has.permission:notas.index')->only(['index']);
        // $this->middleware('has.permission:notas.show')->only(['show']);
        // $this->middleware('has.permission:notas.create')->only(['create', 'store']);
        // $this->middleware('has.permission:notas.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $grados = Grado::query()
                        ->with('subGrados')
                        ->orderBy('abre_grad')
                        ->get();

        if ($request->filled('sub_grado_id') && $request->filled('asignatura_id'))
        {
            $asignaturas = Asignatura::query()
                                    ->select('id', 'nomb_asig')
                                    ->whereHas('grado', function ($queryG) use ($request)
                                    {
                                        $queryG->whereHas('subGrados', function ($queryS) use ($request)
                                        {
                                            $queryS->where('id', $request->sub_grado_id);
                                        });
                                    })
                                    ->orderBy('nomb_asig')
                                    ->get();

            $notas = Nota::query()
                        ->with('estudiante')
                        ->autenticado()
                        ->where('asignatura_id', $request->asignatura_id)
                        ->where('ano_nota', now()->year)
                        ->paginate();
        }

        return view('notas.index', compact('grados', 'asignaturas', 'notas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        //
    }
}
