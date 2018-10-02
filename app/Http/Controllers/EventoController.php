<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\EventoRequest;
use Facades\App\Facades\Jornada;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:eventos.index')->only(['index']);
        $this->middleware('has.permission:eventos.show')->only(['show']);
        $this->middleware('has.permission:eventos.create')->only(['create', 'store']);
        $this->middleware('has.permission:eventos.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:eventos.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $eventos = Evento::query()
                        ->titulo($request->titu_even)
                        ->mostrada($request->filled('most_even'))
                        ->fecha($request->fech_inic, $request->fech_fina)
                        ->autenticado()
                        ->jornada()
                        ->orderByDesc('inic_even')
                        ->orderByDesc('fina_even')
                        ->orderBy('titu_even')
                        ->paginate();

        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jornadas = jornada('asociativos');

        return view('eventos.create', compact('jornadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventoRequest $request)
    {
        $request->validate();

        try
        {
            $evento = new Evento;
            $evento->titu_even = $request->titu_even;
            $evento->foto_even = $this->storePhoto($request->foto_even, 'evento');
            $evento->inic_even = $request->inic_even;
            $evento->fina_even = $request->fina_even;
            $evento->cupo_even = $request->cupo_even;
            $evento->most_even = $request->filled('most_even');
            $evento->desc_even = $request->desc_even;
            $evento->administrativo_id = administrativo('id');
            $evento->save();

            toast('¡El evento ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('eventos.show', $evento->id);

        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar el evento!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        $evento->loadMissing('administrativo');

        return view('eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(EventoRequest $request, Evento $evento)
    {
        $request->validate();

        try
        {
            $evento->titu_even = $request->titu_even;
            $evento->inic_even = $request->inic_even;
            $evento->fina_even = $request->fina_even;
            $evento->cupo_even = $request->cupo_even;
            $evento->most_even = $request->filled('most_even');
            $evento->desc_even = $request->desc_even;
            // $evento->administrativo_id = administrativo('id');

            if ($request->hasFile('foto_even'))
            {
                $this->deletePhoto($evento->foto_even, 'evento');

                $evento->foto_even = $this->storePhoto($request->foto_even, 'evento');
            }

            if ($evento->isDirty())
            {
                $evento->save();
            }

            toast('El evento ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('eventos.show', $evento->id);

        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar el evento!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        try
        {
            $this->deletePhoto($evento->foto_even, 'evento');

            $evento->delete();

            toast('El evento ha sido eliminado correctamente!', 'success', 'top-right');

            return redirect()->route('eventos.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar el evento!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

}
