<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\EstudianteImplemento;
use App\Http\Requests\EstudianteImplementoRequest;
use App\Implemento;
use App\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteImplementoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:estudiantes.implementos.index')->only(['index']);
        $this->middleware('has.permission:estudiantes.implementos.create')->only(['store']);
        $this->middleware('has.permission:estudiantes.implementos.edit')->only(['update']);
        $this->middleware('has.permission:estudiantes.implementos.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Estudiante $estudiante)
    {
        if ($request->ajax())
        {
            try
            {
                $implementos = $estudiante->implementos()
                                        ->wherePivot('ano_util', now()->year)
                                        ->paginate();

                return response()->json([
                    'pagination' => [
                        'total'         => $implementos->total(),
                        'current_page'  => $implementos->currentPage(),
                        'per_page'      => $implementos->perPage(),
                        'last_page'     => $implementos->lastPage(),
                        'from'          => $implementos->firstItem(),
                        'to'            => $implementos->lastItem(),
                    ],
                    'implementos' => $implementos,
                ], 200);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    'message' => '¡Se ha producido un error al cargar los útiles escolares del estudiante!'
                ], 400);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteImplementoRequest $request, Estudiante $estudiante)
    {
        if ($request->ajax())
        {
            $request->validate();

            DB::beginTransaction();

            try
            {
                $currentYear = now()->year;

                /**
                 * Buscamos el registro estudiante-implemento, si no existe lo creamos
                 */
                $estudianteImplemento = EstudianteImplemento::firstOrNew([
                    'estudiante_id' => $estudiante->id,
                    'implemento_id' => $request->implemento_id,
                    'ano_util' => $currentYear,
                ]);
                $estudianteImplemento->cant_util = $request->cant_util;
                $estudianteImplemento->save();

                /**
                 * Consultamos el total de cant_util en estudiante-implemento
                 */
                $stoc_inve = EstudianteImplemento::query()
                                                ->where('implemento_id', $request->implemento_id)
                                                ->where('ano_util', $currentYear)
                                                ->sum('cant_util');

                /**
                 * Buscamos el registro inventario, si no existe lo creamos
                 */
                $inventario = Inventario::firstOrNew([
                    'implemento_id' => $request->implemento_id
                ]);
                $inventario->stoc_inve = $stoc_inve;
                $inventario->administrativo_id = administrativo('id');
                $inventario->save();

                DB::commit();

                return response()->json([
                    'message' => '¡El útil escolar han sido registrado correctamente!'
                ], 200);
            }
            catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al registrar el útil escolar!'
                ], $e->getStatusCode());
            }
            catch (\Exception $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al registrar el útil escolar!'
                ], 400);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @param  \App\Implemento  $implemento
     * @return \Illuminate\Http\Response
     */
    public function update(EstudianteImplementoRequest $request, Estudiante $estudiante, Implemento $implemento)
    {
        if ($request->ajax())
        {
            $request->validate();

            DB::beginTransaction();

            try
            {
                $currentYear = now()->year;

                /**
                 * Buscamos el registro estudiante-implemento
                 */
                $estudianteImplemento = EstudianteImplemento::query()
                                                            ->where('estudiante_id', $estudiante->id)
                                                            ->where('implemento_id', $implemento->id)
                                                            ->where('ano_util', $currentYear)
                                                            ->firstOrFail();

                $estudianteImplemento->cant_util = $request->cant_util;
                $estudianteImplemento->save();

                /**
                 * Consultamos el total de cant_util en estudiante-implemento
                 */
                $stoc_inve = EstudianteImplemento::query()
                                                ->where('implemento_id', $implemento->id)
                                                ->where('ano_util', $currentYear)
                                                ->sum('cant_util');

                /**
                 * Buscamos el registro inventario
                 */
                $inventario = Inventario::query()
                                        ->where('implemento_id', $implemento->id)
                                        ->first();

                if (! is_null($inventario))
                {
                    $inventario->stoc_inve = $stoc_inve;
                    $inventario->save();
                }

                DB::commit();

                return response()->json([
                    'message' => '¡El útil escolar han sido actualizado correctamente!'
                ], 200);
            }
            catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al actualizar el útil escolar!'
                ], $e->getStatusCode());
            }
            catch (\Exception $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al actualizar el útil escolar!'
                ], 400);
            }
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $estudiante
     * @param  \App\Implemento  $implemento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Estudiante $estudiante, Implemento $implemento)
    {
        if ($request->ajax())
        {
            DB::beginTransaction();

            try
            {
                /**
                 * Eliminamos el implemento
                 */
                $estudiante->implementos()->detach($implemento->id);

                /**
                 * Consultamos el total de cant_util en estudiante-implemento
                 */
                $stoc_inve = EstudianteImplemento::query()
                                                ->where('implemento_id', $implemento->id)
                                                ->where('ano_util', now()->year)
                                                ->sum('cant_util');

                /**
                 * Buscamos el registro inventario
                 */
                $inventario = Inventario::query()
                                        ->where('implemento_id', $implemento->id)
                                        ->first();

                if (! is_null($inventario))
                {
                    $inventario->stoc_inve = $stoc_inve;
                    $inventario->save();
                }

                DB::commit();

                return response()->json([
                    'message' => '¡El útil escolar ha sido eliminado correctamente!'
                ], 200);

            }
            catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al eliminar el útil escolar!'
                ], $e->getStatusCode());
            }
            catch (\Exception $e)
            {
                DB::rollback();

                return response()->json([
                    'message' => '¡Se ha producido un error al eliminar el útil escolar!'
                ], 400);
            }
        }
    }
}
