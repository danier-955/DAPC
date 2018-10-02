<?php

namespace App\Http\Controllers;

use App\Programa;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\ProgramaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramaController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:programas.index')->only(['index']);
        $this->middleware('has.permission:programas.create')->only(['create', 'store']);
        $this->middleware('has.permission:programas.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:programas.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $programas = Programa::query()
                            ->nombre($request->nomb_prog)
                            ->orderBy('nomb_prog')
                            ->paginate();

        return view('programas.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramaRequest $request)
    {
        $request->validate();

        try
        {
            $request->merge(['administrativo_id' => administrativo('id')]);

            Programa::create($request->all());

            toast('¡El programa de formación ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('programas.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar el programa de formación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        return view('programas.edit', compact('programa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramaRequest $request, Programa $programa)
    {
        $request->validate();

        try
        {
            $programa->update($request->all());

            toast('¡El programa de formación ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('programas.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar el programa de formación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programa $programa)
    {
        try
        {
            $programa->delete();

            toast('¡El programa de formación ha sido eliminado correctamente!', 'success', 'top-right');

            return redirect()->route('programas.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar el programa de formación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

}
