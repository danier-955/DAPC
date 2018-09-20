<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\PlaneamientoRequest;
use App\Planeamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PlaneamientoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:planeamientos.index')->only(['index']);
        $this->middleware('has.permission:planeamientos.show')->only(['show']);
        $this->middleware('has.permission:planeamientos.show')->only(['create', 'store']);
        $this->middleware('has.permission:planeamientos.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:planeamientos.show')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $request->validate();

        $planeamientos = Planeamiento::query()
                                    ->titulo($request->titu_plan)
                                    ->fecha($request->fech_inic, $request->fech_fina)
                                    ->autenticado()
                                    ->orderByDesc('fech_plan')
                                    ->orderBy('titu_plan')
                                    ->paginate();

        return view('planeamientos.index', compact('planeamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = Docente::queryDocentes();

        return view('planeamientos.create', compact('docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaneamientoRequest $request)
    {
        $request->validate();

        try
        {
            $planeamiento = new Planeamiento;
            $planeamiento->titu_plan = $request->titu_plan;
            $planeamiento->fech_plan = $request->fech_plan;
            $planeamiento->docu_plan = $request->file('docu_plan')->store('', 'planeamiento');
            $planeamiento->desc_plan = $request->desc_plan;
            $planeamiento->docente_id = $request->docente_id;
            $planeamiento->save();

            toast('¡La planeación ha sido registrada correctamente!', 'success', 'top-right');

            return redirect()->route('planeamientos.show', $planeamiento->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar la planeación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Planeamiento  $planeamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Planeamiento $planeamiento)
    {
        return view('planeamientos.show', compact('planeamiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Planeamiento  $planeamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Planeamiento $planeamiento)
    {
        $docentes = Docente::queryDocentes();

        return view('planeamientos.edit', compact('planeamiento','docentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Planeamiento  $planeamiento
     * @return \Illuminate\Http\Response
     */
    public function update(PlaneamientoRequest $request, Planeamiento $planeamiento)
    {
        $request->validate();

        try
        {
            $planeamiento->titu_plan = $request->titu_plan;
            $planeamiento->fech_plan = $request->fech_plan;

            if ($request->hasFile('docu_plan'))
            {
                $this->deleteDocument($planeamiento->docu_plan);

                $planeamiento->docu_plan = $request->file('docu_plan')->store('', 'planeamiento');
            }

            $planeamiento->desc_plan = $request->desc_plan;
            $planeamiento->docente_id = $request->docente_id;
            $planeamiento->save();

            toast('¡La planeación ha sido actualizada correctamente!', 'success', 'top-right');

            return redirect()->route('planeamientos.show', $planeamiento->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar la planeación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Planeamiento  $planeamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planeamiento $planeamiento)
    {
        try
        {
            $this->deleteDocument($planeamiento->docu_plan);

            $planeamiento->delete();

            toast('¡La planeación ha sido eliminada correctamente!', 'success', 'top-right');

            return redirect()->route('planeamientos.index');
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al eliminar la planeación!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Download the specified resource.
     *
     * @param  \App\Planeamiento  $planeamiento
     * @return \Illuminate\Http\Response
     */
    public function download(Planeamiento $planeamiento)
    {
        try
        {
            if (Storage::disk('planeamiento')->exists($planeamiento->docu_plan))
            {
                $titulo = $planeamiento->titu_plan . '.' . File::extension(Storage::disk('planeamiento')->url($planeamiento->docu_plan));

                return Storage::disk('planeamiento')->download($planeamiento->docu_plan, $titulo);
            }
            else
            {
                toast('¡El documento no existe!', 'error', 'top-right');

                return redirect()->back()->withInput();
            }

        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al descargar el documento!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Elimina el documento del disco planeamiento
     *
     * @param  string $docu_plan
     * @return void
     */
    protected function deleteDocument($docu_plan)
    {
        try
        {
            if (Storage::disk('planeamiento')->exists($docu_plan))
            {
                Storage::disk('planeamiento')->delete($docu_plan);
            }
        }
        catch (\Exception $e) { }
    }
}
