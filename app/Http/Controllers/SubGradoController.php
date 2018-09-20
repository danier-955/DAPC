<?php

namespace App\Http\Controllers;

use App\SubGrado;
use App\Grado;
use App\Docente;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SubGradoRequest;
use Illuminate\Http\Request;

class subgradoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:subgrados.index')->only(['index']);
        $this->middleware('has.permission:subgrados.show')->only(['show']);
        $this->middleware('has.permission:subgrados.create')->only(['create', 'store']);
        $this->middleware('has.permission:subgrados.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subGrados = SubGrado::query()
                            ->orderBy('abre_subg')
                            ->paginate();

        return view('grados.subgrados.index',compact('subGrados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grados = Grado::all();
        $docentes = Docente::queryDocentes();
        return view('grados.subgrados.create',compact('grados','docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubGradoRequest $request)
    {
        $request->validate();

        DB::beginTransaction(); 

        try 
        {  
            $subgrado = SubGrado::create($request->all());

            /**
             * Agregar grado al docente director
             */
            // if ($request->has('docente_id'))
            if (! is_null($request->docente_id) && $request->docente_id !== '')
            {   
                $director = Docente::withCount('subGrados')->findOrFail($request->docente_id);
                
                if ($director->sub_grados_count > 0)
                {
                    $director->subGrados()->detach();
                }

                $subgrado->docentes()->sync($request->docente_id);
            }

            DB::commit();

            toast('¡El Sub grado ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('subgrados.index');
        } 
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el Sub grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e) 
        {
            DB::rollback();            

            toast('¡Se ha producido un error al registrar el Sub grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubGrado $subgrado
     * @return \Illuminate\Http\Response
     */
    public function show(SubGrado $subgrado)
    {
        return view('grados.subgrados.show', compact('subgrado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubGrado  $subgrado
     * @return \Illuminate\Http\Response
     */
    public function edit(SubGrado $subgrado)
    {
        $grados = Grado::all();
        $docentes = Docente::queryDocentes();

        return view('grados.subgrados.edit',compact('subgrado','grados','docentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubGrado  $subgrado
     * @return \Illuminate\Http\Response
     */
    public function update(SubGradoRequest $request, SubGrado $subgrado)
    {
        $request->validate();
        DB::beginTransaction(); 
        try 
        {   
            $subgrado->update($request->all());

            /**
             * Agregar grado al docente director
             */
            if (! is_null($request->docente_id) && $request->docente_id !== '')
            {   
                $director = Docente::withCount('subGrados')->findOrFail($request->docente_id);
                
                if ($director->sub_grados_count > 0)
                {
                    $director->subGrados()->detach();
                }

                $subgrado->docentes()->sync($request->docente_id);
            }
            
            DB::commit();

            toast('¡El Sub grado ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('subgrados.index');
        } 
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            // dd($e->getMessage());
            DB::rollback();


            toast('¡Se ha producido un error al actualizar el Sub grado!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e) 
        {
            // dd($e->getMessage());
            DB::rollback();
            

            toast('¡Se ha producido un error al actualizar el Sub grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubGrado  $subgrado
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubGrado $subgrado)
    {
        try
        {
            $subgrado->delete();

            toast('¡El Sub grado ha sido eliminado correctamente!', 'success', 'top-right');

            return redirect()->route('subgrados.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar el Sub grado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
