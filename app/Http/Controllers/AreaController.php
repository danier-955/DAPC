<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\AreasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:areas.index')->only(['index']);
        $this->middleware('has.permission:areas.create')->only(['create', 'store']);
        $this->middleware('has.permission:areas.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:areas.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
        $areas = Area::query()
                            ->area($request->nomb_area)
                            ->orderBy('nomb_area')
                            ->paginate();
        return view('areas.index' , compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreasRequest $request)
    {
        $request->validate();
        try
        {
            $area = Area::create($request->all());

            toast('¡La Area ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('areas.index', $area->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al registrar la area!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    { 
         return view('areas.edit' , compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreasRequest $request, Area $area)
    {
        $request->validate();
        
        try {
        
            $area->update($request->all());

            toast('¡La area ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('areas.index', $area->id);

        } 
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar la area!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        try
        {
            $area->delete();

            toast('¡el area ha sido eliminada correctamente!', 'success', 'top-right');

            return redirect()->route('areas.index');
        }
        catch (\Exception $e)
        {  
            toast('¡Se ha producido un error al eliminar el area!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
