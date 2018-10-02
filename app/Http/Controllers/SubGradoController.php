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
        $this->middleware('has.permission:subgrados.show')->only(['show']);
        $this->middleware('has.permission:subgrados.create')->only(['create', 'store']);
        $this->middleware('has.permission:subgrados.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Grado $grado
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Grado $grado)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Grado $grado
     * @return \Illuminate\Http\Response
     */
    public function create(Grado $grado)
    {
        $docentes = Docente::queryDocentes();

        return view('grados.subgrados.create',compact('grado', 'docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Grado $grado
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubGradoRequest $request, Grado $grado)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            $request->merge(['grado_id' => $grado->id]);

            $subgrado = SubGrado::create($request->all());

            /**
             * Agregar grado al docente director
             */
            if ($request->filled('docente_id'))
            {
                $director = Docente::withCount('subGrados')->findOrFail($request->docente_id);

                if ($director->sub_grados_count > 0)
                {
                    $director->subGrados()->detach();
                }

                $subgrado->docentes()->sync($request->docente_id);
            }

            DB::commit();

            toast('¡El subgrado ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.show', $grado->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el subgrado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el subgrado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grado $grado
     * @param  \App\SubGrado $subgrado
     * @return \Illuminate\Http\Response
     */
    public function show(Grado $grado, SubGrado $subgrado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grado $grado
     * @param  \App\SubGrado  $subgrado
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado, SubGrado $subgrado)
    {
        $docentes = Docente::queryDocentes();

        return view('grados.subgrados.edit',compact('grado', 'subgrado', 'docentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grado $grado
     * @param  \App\SubGrado  $subgrado
     * @return \Illuminate\Http\Response
     */
    public function update(SubGradoRequest $request, Grado $grado, SubGrado $subgrado)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            $subgrado->update($request->all());

            /**
             * Agregar grado al docente director
             */
            if ($request->filled('docente_id'))
            {
                $director = Docente::withCount('subGrados')->findOrFail($request->docente_id);

                if ($director->sub_grados_count > 0)
                {
                    $director->subGrados()->detach();
                }

                $subgrado->docentes()->sync($request->docente_id);
            }

            DB::commit();

            toast('¡El subgrado ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('grados.show', $grado->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el subgrado!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el subgrado!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grado $grado
     * @param  \App\SubGrado  $subgrado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grado $grado, SubGrado $subgrado)
    {
        //
    }
}
