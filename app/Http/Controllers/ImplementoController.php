<?php

namespace App\Http\Controllers;

use App\Implemento;
use App\SubGrado;
use App\Grado;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\ImplementosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImplementoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:implementos.index')->only(['index']);
        $this->middleware('has.permission:implementos.show')->only(['show']);
        $this->middleware('has.permission:implementos.create')->only(['create', 'store']);
        $this->middleware('has.permission:implementos.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:implementos.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {   
        $request->validate();
        
        $grados = Grado::with('subGrados')
            ->orderBy('abre_grad')
            ->get();
        $implementos = Implemento::query()
                            ->util($request->nomb_util)
                            ->orderBy('nomb_util')
                            ->paginate();
        return view('implementos.index' , compact('implementos','grados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grados = Grado::with('subGrados')
                ->orderBy('abre_grad')
                ->get();

        return view('implementos.create',compact('grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImplementosRequest $request)
    {
         $request->validate();
        try
        {
            /**
             * Registrar el implementos
             */
            $implemento = Implemento::create($request->all());

            if ($request->has('subgrados'))
            {
                $implemento->subGrados()->sync($request->get('subgrados'));
            }

            toast('¡El Util ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('implementos.show', $implemento->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar el Util!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\implemento  $implemento
     * @return \Illuminate\Http\Response
     */
    public function show(Implemento $implemento)
    {
         return view('implementos.show' , compact ('implemento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Implemento  $implemento
     * @return \Illuminate\Http\Response
     */
    public function edit(Implemento $implemento)
    {
         $grados = Grado::query()
                        ->with('subGrados')
                        ->orderBy('abre_grad')
                        ->orderBy('jorn_grad')
                        ->get();

        return view('implementos.edit',compact('implemento','grados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Implemento  $implemento
     * @return \Illuminate\Http\Response
     */
    public function update(ImplementosRequest $request, Implemento $implemento)
    {
        $request->validate();
        
        try {
        
            $implemento->update($request->all());

            toast('¡El Util ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('implementos.show', $implemento->id);

        } 
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el Util!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Implemento  $implemento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Implemento $implemento)
    {
        try
        {
            $implemento->delete();

            toast('¡el Util ha sido eliminada correctamente!', 'success', 'top-right');

            return redirect()->route('implementos.index');
        }
        catch (\Exception $e)
        {  
            toast('¡Se ha producido un error al eliminar el Util!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
