<?php

namespace App\Http\Controllers;

use App\Grado;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\GradoRequest;
use Facades\App\Facades\Jornada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:grados.index')->only(['index']);
        $this->middleware('has.permission:grados.create')->only(['create', 'store']);
        $this->middleware('has.permission:grados.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $grados = Grado::query()
                        ->nombre($request->nomb_grad)
                        ->jornada($request->jorn_grad)
                        ->orderBy('abre_grad')
                        ->orderBy('nomb_grad')
                        ->paginate();

        $jornadas = Jornada::asociativos();

        return view('grados.index', compact('grados', 'jornadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradoRequest $request)
    {
        $request->validate();

        try
        {
            Grado::create($request->all());

            toast('¡El grado ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar el grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function show(Grado $grado)
    {
        $grado->loadMissing('subGrados.docentes');

        return view('grados.show' , compact('grado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado)
    {
        $jornadas = Jornada::asociativos();

        $grado->loadMissing('subGrados.docentes');

        return view('grados.edit', compact('grado', 'jornadas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function update(GradoRequest $request, Grado $grado)
    {
        $request->validate();

        try
        {
            $grado->update($request->all());

            toast('¡El grado ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.index');
        }
        catch (\Exception $e)
        {
           toast('¡Se ha producido un error al actualizar el grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grado $grado)
    {
        //
    }
}
