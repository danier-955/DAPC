<?php

namespace App\Http\Controllers;

use App\Grado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GradoRequest;
use App\Http\Requests\BusquedaRequest;

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
        $this->middleware('has.permission:grados.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $grados = Grado::query()
                            ->nombreGrado($request->nomb_grad)
                            ->orderBy('abre_grad')
                            ->paginate(10);

        return view('grados.index', compact('grados','grados'));
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
            
            DB::commit();

            toast('¡El Grado ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.index');
        } 
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            dd($e->getMessage());
            DB::rollback();


            toast('¡Se ha producido un error al registrar el Grado!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e) 
        {
            dd($e->getMessage());
            DB::rollback();
            

            toast('¡Se ha producido un error al registrar el Grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado)
    {
        return view('grados.edit',compact('grado'));
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
            
            DB::commit();

            toast('¡El Grado ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.index');
        } 
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            // dd($e->getMessage());
            DB::rollback();


            toast('¡Se ha producido un error al actualizar el Grado!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e) 
        {
            // dd($e->getMessage());
            DB::rollback();
            

            toast('¡Se ha producido un error al actualizar el Grado!', 'error', 'top-right');

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
        try
        {
            $grado->delete();

            toast('¡El grado ha sido eliminado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar el grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
