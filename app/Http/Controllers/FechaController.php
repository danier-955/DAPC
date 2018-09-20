<?php

namespace App\Http\Controllers;

use App\Fecha;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\FechaRequest;
use Illuminate\Http\Request;

class FechaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:fechas.index')->only(['index']);
        $this->middleware('has.permission:fechas.show')->only(['show']);
        $this->middleware('has.permission:fechas.create')->only(['create', 'store']);
        $this->middleware('has.permission:fechas.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $fechas = Fecha::query()
                        ->year($request->ano_fech)
                        ->orderByDesc('ano_fech')
                        ->orderByDesc('created_at')
                        ->paginate();

        return view('fechas.index', compact('fechas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fechas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FechaRequest $request)
    {
        $request->validate();

        try
        {
            $ano_fech = now()->year;

            if ($ano_fech !== $request->ano_fech)
            {
                toast('¡El año de la fecha de notas no puede ser adulterado!', 'error', 'top-right');

                return redirect()->back()->withInput();
            }

            $data = $this->prepareJSON($request);

            $data['ano_fech'] = $ano_fech;

            $fecha = Fecha::create($data);

            toast('La fecha de notas ha sido registrada correctamente!', 'success', 'top-right');

            return redirect()->route('fechas.show', $fecha->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registar la fecha de notas!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function show(Fecha $fecha)
    {
        return view('fechas.show', compact('fecha'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function edit(Fecha $fecha)
    {
        return view('fechas.edit', compact('fecha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function update(FechaRequest $request, Fecha $fecha)
    {
        $request->validate();

        try
        {
            $fecha->update($this->prepareJSON($request));

            toast('¡La fecha de notas ha sido actualizada correctamente!', 'success', 'top-right');

            return redirect()->route('fechas.show', $fecha->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar la fecha de notas!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fecha $fecha)
    {
        //
    }

    protected function prepareJSON(FechaRequest $request)
    {
        return [
            'fech_not1' => [
                'fech_inic' => $request->fech_not1_inic,
                'fech_fina' => $request->fech_not1_fina
            ],
            'fech_not2' => [
                'fech_inic' => $request->fech_not2_inic,
                'fech_fina' => $request->fech_not2_fina
            ],
            'fech_not3' => [
                'fech_inic' => $request->fech_not3_inic,
                'fech_fina' => $request->fech_not3_fina
            ],
            'fech_not4' => [
                'fech_inic' => $request->fech_not4_inic,
                'fech_fina' => $request->fech_not4_fina
            ],
            'fech_rec1' => [
                'fech_inic' => $request->fech_rec1_inic,
                'fech_fina' => $request->fech_rec1_fina
            ],
            'fech_rec2' => [
                'fech_inic' => $request->fech_rec2_inic,
                'fech_fina' => $request->fech_rec2_fina
            ],
            'fech_rec3' => [
                'fech_inic' => $request->fech_rec3_inic,
                'fech_fina' => $request->fech_rec3_fina
            ],
            'fech_rec4' => [
                'fech_inic' => $request->fech_rec4_inic,
                'fech_fina' => $request->fech_rec4_fina
            ],
        ];
    }
}
