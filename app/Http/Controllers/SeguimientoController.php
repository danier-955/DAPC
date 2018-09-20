<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\SeguimientoRequest;
use App\Practicante;
use App\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:seguimientos.index')->only(['index']);
        $this->middleware('has.permission:seguimientos.show')->only(['show']);
        $this->middleware('has.permission:seguimientos.show')->only(['create', 'store']);
        $this->middleware('has.permission:seguimientos.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $seguimientos = Seguimiento::query()
                                    ->fecha($request->fech_inic, $request->fech_fina)
                                    ->autenticado()
                                    ->orderByDesc('fech_segu')
                                    ->orderByDesc('created_at')
                                    ->paginate();

        return view('seguimientos.index', compact('seguimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = Docente::queryDocentes();

        $practicantes = Practicante::query()
                                    ->select('id', 'nomb_prac', 'pape_prac', 'sape_prac')
                                    ->orderBy('nomb_prac')
                                    ->orderBy('pape_prac')
                                    ->get();

        return view('seguimientos.create', compact('docentes', 'practicantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeguimientoRequest $request)
    {
        $request->validate();

        try
        {
            $seguimiento = Seguimiento::create($request->all());

            toast('¡El seguimiento ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('seguimientos.show', $seguimiento->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registar el seguimiento!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function show(Seguimiento $seguimiento)
    {
        return view('seguimientos.show', compact('seguimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguimiento $seguimiento)
    {
        $docentes = Docente::queryDocentes();

        $practicantes = Practicante::query()
                                    ->select('id', 'nomb_prac', 'pape_prac', 'sape_prac')
                                    ->orderBy('nomb_prac')
                                    ->orderBy('pape_prac')
                                    ->get();

        return view('seguimientos.edit', compact('seguimiento', 'docentes', 'practicantes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function update(SeguimientoRequest $request, Seguimiento $seguimiento)
    {
        $request->validate();

        try
        {
            $seguimiento->update($request->all());

            toast('¡El seguimiento ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('seguimientos.show', $seguimiento->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar el seguimiento!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Practicante  $practicante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seguimiento $seguimiento)
    {
        //
    }
}
