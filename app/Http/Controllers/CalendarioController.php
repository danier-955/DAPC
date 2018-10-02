<?php

namespace App\Http\Controllers;

use App\Administrativo;
use App\Calendario;
use App\Http\Requests\CalendarioRequest;
use Caffeinated\Shinobi\Facades\Shinobi;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Jornada;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:calendarios.index')->only(['index', 'event']);
        $this->middleware('has.permission:calendarios.create')->only(['store']);
        $this->middleware('has.permission:calendarios.edit')->only(['update']);
        $this->middleware('has.permission:calendarios.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$administrativos = Administrativo::query()
                                        ->select('id', 'nomb_admi', 'pape_admi', 'sape_admi')
                                        ->whereNotIn('carg_admi', [Cargo::secretaria()])
                                        ->autenticado()
                                        ->orderBy('nomb_admi')
                                        ->orderBy('pape_admi')
                                        ->orderBy('sape_admi')
                                        ->get();*/

        $jornadas = [
            'autenticado' => administrativo('jorn_admi'),
            'registrar' => jornada('asociativos'),
            'ver' => Jornada::adminAsociativos(),
        ];

        return view('calendarios.index', compact('jornadas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function event(Request $request)
    {
        try
        {
            if ($request->ajax())
            {
                $calendarios = Calendario::query()
                                        ->with('administrativo:id,nomb_admi,pape_admi,sape_admi')
                                        ->select('calendarios.id as idCalendario', 'titu_cale as title', 'fech_inic as start', 'fech_fina as end', 'jorn_cale', 'desc_cale', 'administrativo_id')
                                        ->fecha($request->start, $request->end)
                                        ->jornada()
                                        ->get()
                                        ->toArray();

                return response()->json($calendarios);
            }
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al cargar el calendario!'
            ], $e->getStatusCode());
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al cargar el calendario!'
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarioRequest $request)
    {
        $request->validate();

        try
        {
            $request->merge([
                'administrativo_id' => administrativo('id'),
            ]);

            Calendario::create($request->all());

            return response()->json([
                'message' => '¡El calendario ha sido registrado correctamente!'
            ], 200);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al guardar en calendario!'
            ], $e->getStatusCode());
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al guardar en calendario!'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarioRequest $request, Calendario $calendario)
    {
        $request->validate();

        try
        {
            $calendario->update($request->except('id'));

            return response()->json([
                'message' => '¡El calendario ha sido actualizado correctamente!'
            ], 200);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al actualizar en calendario!'
            ], $e->getStatusCode());
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al actualizar en calendario!'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendario $calendario)
    {
        try
        {
            $calendario->delete();

            return response()->json([
                'message' => '¡El calendario ha sido eliminado correctamente!'
            ], 200);

        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al eliminar en calendario!'
            ], $e->getStatusCode());
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => '¡Se ha producido un error al eliminar en calendario!'
            ], 400);
        }
    }
}
