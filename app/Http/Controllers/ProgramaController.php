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
        $this->middleware('has.permission:programas.show')->only(['show']);
        $this->middleware('has.permission:programas.create')->only(['create', 'store']);
        $this->middleware('has.permission:programas.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:programas.show')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $programas = Programa::query()
                            ->withoutGlobalScopes()
                            ->Programa($request->nomb_prog)
                            ->orderBy('nomb_prog')
                            ->paginate();;
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

        DB::beginTransaction();

        try
        {
            /**
             * Registrar el programas
             */

            $administrativo = $this->getAdministrativo();

            $programa = new Programa;
            $programa->nomb_prog = $request->nomb_prog;
            $programa->desc_prog = $request->desc_prog;
            $programa->administrativo_id = $administrativo->id;
            $programa->save();

            DB::commit();

            toast('¡El  Programa Formación ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('programas.index', $programa->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el  Programa Formación!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            // dd($e->getMessage());
            DB::rollback();

            toast('¡Se ha producido un error al registrar el  Programa Formación!', 'success', 'top-right');

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
        
        try {
            
             $programa->update($request->all());

            DB::commit();

            toast('¡El Programa de Formación ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('programas.index', $programa->id);

        } 
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el Programa Formación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el Programa Formación!', 'error', 'top-right');

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

            toast('¡el Programa Formación ha sido eliminada correctamente!', 'success', 'top-right');

            return redirect()->route('programas.index');
        }
        catch (\Exception $e)
        {  
            toast('¡Se ha producido un error al eliminar el Programa Formación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

     /**
     * Devuelve el modelo admiistrativo asociado al usuario autenticado.
     *
     * @return \App\Administrativo  $administrativo
     */
    protected function getAdministrativo()
    {
        $usuario = auth()->user()->load('administrativo');

        if (is_null($usuario->administrativo))
        {
            toast('¡El administrativo no es válido para registrar la galeria!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }

        return $usuario->administrativo;
    }
}
