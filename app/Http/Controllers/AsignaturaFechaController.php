<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\AsignaturaFecha;
use App\Fecha;
use App\Http\Requests\AsignaturaFechaRequest;
use App\Http\Requests\BusquedaRequest;
use Facades\App\Facades\Periodo;
use Facades\App\Facades\TipoNota;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class AsignaturaFechaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:asignaturas.fechas.index')->only(['index']);
        $this->middleware('has.permission:asignaturas.fechas.show')->only(['show']);
        $this->middleware('has.permission:asignaturas.fechas.show')->only(['create', 'store']);
        $this->middleware('has.permission:asignaturas.fechas.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request, Asignatura $asignatura)
    {
        $request->validate();

        $fechaExiste = $this->existeFechaAnualYNoFechaAsignatura($asignatura);

        $fechas = $asignatura->fechas()
                            ->pivotFecha($request->fech_inic, $request->fech_fina)
                            ->pivotPeriodo($request->peri_nota)
                            ->pivotTipoNota($request->tipo_nota)
                            ->paginate();

        return view('asignaturas.fechas.index', compact('asignatura', 'fechas', 'fechaExiste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function create(Asignatura $asignatura)
    {
        $fechaExiste = $this->existeFechaAnualYNoFechaAsignatura($asignatura);

        return view('asignaturas.fechas.create', compact('asignatura', 'fechaExiste'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AsignaturaFechaRequest  $request
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function store(AsignaturaFechaRequest $request, Asignatura $asignatura)
    {
        $request->validate();

        try
        {
            /**
             * Obtener las fechas del año actual
             */
            $fecha = Fecha::query()
                            ->withoutGlobalScopes()
                            ->where('ano_fech', now()->format('Y'))
                            ->firstOrFail();

            /**
             * Guardar la fecha extracurricular
             */
            $asignaturaFecha = AsignaturaFecha::create([
                'fech_nota' => [
                    'fech_inic' => $request->fech_inic,
                    'fech_fina' => $request->fech_fina
                ],
                'peri_nota' => $request->peri_nota,
                'moti_nota' => $request->moti_nota,
                'tipo_nota' => $request->tipo_nota,
                'asignatura_id' => $asignatura->id,
                'fecha_id'  => $fecha->id,
            ]);

            toast('¡La fecha extracurricular ha sido registrada correctamente!', 'success', 'top-right');

            return redirect()->route('asignaturas.fechas.show', [$asignatura->id, $asignaturaFecha->id]);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registar la fecha extracurricular!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura, AsignaturaFecha $fecha)
    {
        $fechaExiste = $this->existeFechaAnualYNoFechaAsignatura($asignatura);

        return view('asignaturas.fechas.show', compact('asignatura', 'fecha', 'fechaExiste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignatura $asignatura, AsignaturaFecha $fecha)
    {
        $fechaExiste = $this->existeFechaAnualYNoFechaAsignatura($asignatura, $fecha);

        return view('asignaturas.fechas.edit', compact('asignatura', 'fecha', 'fechaExiste'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AsignaturaFechaRequest  $request
     * @param  \App\Asignatura  $asignatura
     * @param  \App\AsignaturaFecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function update(AsignaturaFechaRequest $request, Asignatura $asignatura, AsignaturaFecha $fecha)
    {
        $request->validate();

        try
        {
            $fecha->update([
                'fech_nota' => [
                    'fech_inic' => $request->fech_inic,
                    'fech_fina' => $request->fech_fina
                ],
                'peri_nota' => $request->peri_nota,
                'moti_nota' => $request->moti_nota,
                'tipo_nota' => $request->tipo_nota,
            ]);

            toast('¡La fecha extracurricular ha sido actualizada correctamente!', 'success', 'top-right');

            return redirect()->route('asignaturas.fechas.show', [$asignatura->id, $fecha->id]);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar la fecha extracurricular!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignatura $asignatura, AsignaturaFecha $fecha)
    {
        //
    }

    /**
     * Devuelve true si existe una fecha de notas con año actual registrada y no hay una fecha de asignaturas pendiente.
     *
     * @param  \App\Asignatura  $asignatura
     * @param  \App\AsignaturaFecha  $pivot
     * @return boolean
     */
    protected function existeFechaAnualYNoFechaAsignatura(Asignatura $asignatura, $pivot = null)
    {
        $today = now();

        /**
         * Opcion 1
         */
        $fecha = Fecha::query()
                    ->withoutGlobalScopes()
                    ->where('ano_fech', $today->year)
                    ->first();

        $asignaturaFecha = AsignaturaFecha::query()
                                ->where('asignatura_id', $asignatura->id)
                                ->where('fecha_id', optional($fecha)->id)
                                ->where('fech_nota->fech_inic', '<=', $today)
                                ->where('fech_nota->fech_fina', '>=', $today)
                                ->get();

        $resultado = (! is_null($fecha) && ($asignaturaFecha->count() === 0)) ? true : false;

        if (! $resultado && ! is_null($pivot))
        {
            return ($asignaturaFecha->where('id', $pivot->id)->count() > 0) ? true : false;
        }

        return $resultado;

        /**
         * Opcion 2
         */
        /*$fecha = Fecha::query()
                    ->with(['asignaturas' => function ($query) use ($asignatura, $today)
                    {
                        $query->withoutGlobalScopes()
                            ->where('asignatura_id', $asignatura->id)
                            ->wherePivot('fech_nota->fech_inic', '<=', $today)
                            ->wherePivot('fech_nota->fech_fina', '>=', $today);
                    }])
                    ->where('ano_fech', $today->year)
                    ->first();

        $resultado = (! is_null($fecha) && $fecha->asignaturas->count() === 0) ? true : false;

        if (! $resultado && ! is_null($pivot))
        {
            foreach ($fecha->asignaturas as $asignatura)
            {
                if ($asignatura->pivot->id === $pivot->id)
                {
                    $resultado = true;
                    break;
                }
            }
        }

        return $resultado;*/
    }
}
