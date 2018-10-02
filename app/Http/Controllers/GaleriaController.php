<?php

namespace App\Http\Controllers;

use App\Galeria;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\GaleriaRequest;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Jornada;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:galerias.index')->only(['index']);
        $this->middleware('has.permission:galerias.show')->only(['show']);
        $this->middleware('has.permission:galerias.create')->only(['create', 'store']);
        $this->middleware('has.permission:galerias.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:galerias.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $galerias = Galeria::query()
                            ->with('administrativo')
                            ->titulo($request->titu_gale)
                            ->mostrada($request->filled('most_gale'))
                            ->autenticado()
                            ->jornada()
                            ->orderByDesc('updated_at')
                            ->orderBy('titu_gale')
                            ->paginate();

        return view('galerias.index', compact('galerias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jornadas = jornada('asociativos');

        return view('galerias.create', compact('jornadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GaleriaRequest $request)
    {
        $request->validate();

        try
        {
            $galeria = new Galeria;
            $galeria->titu_gale = $request->titu_gale;
            $galeria->desc_gale = $request->desc_gale;
            $galeria->foto_gale = $this->storePhoto($request->foto_gale, 'galeria');
            $galeria->most_gale = $request->filled('most_gale');
            $galeria->jorn_gale = $request->jorn_gale;
            $galeria->administrativo_id = administrativo('id');
            $galeria->save();

            toast('¡La galeria ha sido registrada correctamente!', 'success', 'top-right');

            return redirect()->route('galerias.index');

        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar la galeria!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeria $galeria)
    {
        return view('galerias.edit', compact('galeria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function update(GaleriaRequest $request, Galeria $galeria)
    {
        $request->validate();

        try
        {
            $galeria->titu_gale = $request->titu_gale;
            $galeria->desc_gale = $request->desc_gale;
            $galeria->most_gale = $request->filled('most_gale');
            // $galeria->administrativo_id = administrativo('id');

            if ($request->hasFile('foto_gale'))
            {
                $this->deletePhoto($galeria->foto_gale, 'galeria');

                $galeria->foto_gale = $this->storePhoto($request->foto_gale, 'galeria');
            }

            if ($galeria->isDirty())
            {
                $galeria->save();
            }

            toast('¡La galeria ha sido actualizada correctamente!', 'success', 'top-right');

            return redirect()->route('galerias.index');

        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar la galeria!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeria $galeria)
    {
        try
        {
            $this->deletePhoto($galeria->foto_gale, 'galeria');

            $galeria->delete();

            toast('¡La galeria ha sido eliminada correctamente!', 'success', 'top-right');

            return redirect()->route('galerias.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar la galeria!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

}
