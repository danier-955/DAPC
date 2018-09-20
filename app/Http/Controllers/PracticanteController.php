<?php

namespace App\Http\Controllers;

use App\Grado;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\PracticanteRequest;
use App\Practicante;
use App\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticanteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:practicantes.index')->only(['index']);
        $this->middleware('has.permission:practicantes.show')->only(['show']);
        $this->middleware('has.permission:practicantes.show')->only(['create', 'store']);
        $this->middleware('has.permission:practicantes.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $practicantes = Practicante::query()
                                    ->documento($request->docu_prac)
                                    ->nombre($request->nomb_prac)
                                    ->primerApellido($request->pape_prac)
                                    ->segundoApellido($request->sape_prac)
                                    ->orderBy('pape_prac')
                                    ->orderBy('nomb_prac')
                                    ->paginate();

        return view('practicantes.index' , compact('practicantes'));
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
                        ->orderBy('jorn_grad')
                        ->get();

        return view('practicantes.create' , compact('grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PracticanteRequest $request)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            /**
             * Registrar el practicante
             */
            $practicante = Practicante::create($request->all());

            /**
            * SubGrado del practicante
            */
            $practicante->subGrados()->sync($request->sub_grado_id);

            DB::commit();

            toast('¡El practicante ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('practicantes.show', $practicante->id);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el practicante!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el practicante!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function show(Practicante $practicante)
    {
        $practicante->load('subGrados.grado');

        $seguimientos = Seguimiento::query()
                                    ->where('practicante_id', $practicante->id)
                                    ->orderBy('fech_segu')
                                    ->orderByDesc('created_at')
                                    ->paginate();

        // $seguimientos = $practicante->docentes()
        //                             ->withoutGlobalScopes()
        //                             ->paginate();

        return view('practicantes.show', compact('practicante', 'seguimientos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function edit(Practicante $practicante)
    {
        $grados = Grado::query()
                        ->with('subGrados')
                        ->orderBy('abre_grad')
                        ->orderBy('jorn_grad')
                        ->get();

        $practicante->load('subGrados.grado');

        return view('practicantes.edit', compact('practicante','grados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function update(PracticanteRequest $request, Practicante $practicante)
    {
        $request->validate();

        DB::beginTransaction();

        try
        {
            /**
             * Actualizar el practicante
             */
            $practicante->update($request->all());

            /**
            * SubGrado del practicante
            */
            $practicante->subGrados()->sync($request->sub_grado_id);

            DB::commit();

            toast('¡El practicante ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('practicantes.show', $practicante->id);

        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el practicante!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el practicante!', 'success', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Practicante $practicante)
    {
        //
    }

}
