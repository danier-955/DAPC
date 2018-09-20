<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\EstudianteImplemento;
use App\Http\Requests\BusquedaRequest;
use App\Http\Requests\EstudianteInventarioRequest;
use App\Implemento;
use App\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:inventarios.index')->only(['index']);
        $this->middleware('has.permission:inventarios.create')->only(['create', 'store']);
        $this->middleware('has.permission:inventarios.edit')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventarios =Inventario::with('administrativo','implemento')
                            ->paginate();
     

        return view('inventarios.index' , compact ('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BusquedaRequest $request)
    {
       $request->validate();

        $estudiantes = Estudiante::queryEstudiantes();

        $implementos = Implemento::query()
                            ->select('id', 'nomb_util')
                            ->orderBy('nomb_util')
                            ->get();

        return view('inventarios.create' , compact('estudiantes', 'implementos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteInventarioRequest $request)
    {
        if ($request->ajax())
        {
            $request->validate();

            DB::beginTransaction();

            try
            {
                /**
                 * Buscamos el registro estudiante-implemento, si no existe lo creamos
                 */
                $estudianteImplemento = EstudianteImplemento::firstOrNew([
                    'estudiante_id' => $request->estudiante_id,
                    'implemento_id' => $request->implemento_id
                ]);
                $estudianteImplemento->cant_util = $request->cant_util;
                $estudianteImplemento->save();

                /**
                 * Consultamos el total de cant_util en estudiante-implemento
                 */
                $stoc_inve = EstudianteImplemento::query()
                                                ->where('implemento_id', $request->implemento_id)
                                                ->sum('cant_util');

                /**
                 * Buscamos el registro inventario, si no existe lo creamos
                 */
                $inventario = Inventario::firstOrNew([
                    'implemento_id' => $request->implemento_id
                ]);
                $inventario->stoc_inve = $stoc_inve;
                $inventario->administrativo_id = $this->getAdministrativoId();
                $inventario->save();

                DB::commit();

                return response()->json([
                    'message' => '¡El útil han sido registrados correctamente!'
                ], 200);
            }
            catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al guardar el útil!'
                ], $e->getStatusCode());
            }
            catch (\Exception $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al guardar el útil!'
                ], 400);
            }
        }
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
         $estudiante = Estudiante::query()
                                    ->select('id', 'nomb_estu', 'pape_estu', 'sape_estu')
                                    ->orderBy('nomb_estu')
                                    ->orderBy('pape_estu')
                                    ->get();

        return view('inventarios.edit' , compact('inventarios','estudiante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
   public function destroy(EstudianteImplemento $inventario)
    {

        DB::beginTransaction();

        try
        {   
            $implementoId = $inventario->implemento_id;

            $inventario->delete();

            /**
             * Consultamos el total de cant_util en estudiante-implemento
             */
            $stoc_inve = EstudianteImplemento::query()
                                            ->where('implemento_id', $implementoId)
                                            ->sum('cant_util');

            /**
             * Buscamos el registro inventario, si no existe lo creamos
             */
            $inventarios = Inventario::where('implemento_id', $implementoId)->firstOrFail();
            $inventarios->stoc_inve = $stoc_inve;
            $inventarios->save();

            DB::commit();

            return response()->json([
                'message' => '¡El útil han sido eliminado correctamente!'
            ], 200);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            return response()->json([
                'message' => '¡Se ha producido un error al eliminar el útil!'
            ], $e->getStatusCode());
        }
        catch (\Exception $e)
        {
            DB::rollback();

            return response()->json([
                'message' => '¡Se ha producido un error al eliminar el útil!'
            ], 400);
        }
    }

      /**
     * Devuelve el modelo admiistrativo asociado al usuario autenticado.
     *
     * @return \App\Administrativo  $administrativo
     */
    protected function getAdministrativoId()
    {
        $usuario = auth()->user()->load('administrativo');

        return optional($usuario->administrativo)->id;
    }

}