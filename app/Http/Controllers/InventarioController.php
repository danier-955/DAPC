<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\EstudianteImplemento;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\EstudianteInventarioRequest;
use App\Implemento;
use App\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:inventarios.index')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        /*$inventarios = Inventario::query()
                                ->with('administrativo', 'implemento')
                                ->orderBy('implemento_id')
                                ->paginate();*/

        $implementos = Implemento::query()
                                ->has('inventarios')
                                ->with('inventarios.administrativo')
                                ->nombre($request->nomb_util)
                                ->orderBy('nomb_util')
                                ->paginate();

        return view('inventarios.index', compact ('implementos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BusquedaRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteInventarioRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstudianteImplemento $inventario)
    {
        //
    }

}