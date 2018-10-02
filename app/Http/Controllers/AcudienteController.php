<?php

namespace App\Http\Controllers;

use App\Acudiente;
use App\User;
use App\Role;
use App\Http\Requests\BusquedaRequest;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\Documento;
use Facades\App\Facades\Estado;
use App\Http\Requests\AcudienteRequest;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcudienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:acudientes.index')->only(['index']);
        $this->middleware('has.permission:acudientes.show')->only(['show']);
        $this->middleware('has.permission:acudientes.create')->only(['create', 'store']);
        $this->middleware('has.permission:acudientes.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:estudiantes.create')->only(['search']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusquedaRequest $request)
    {
         $acudientes = Acudiente::query()
                                ->documento($request->docu_acud)
                                ->nombre($request->nomb_acud)
                                ->primerApellido($request->pape_acud)
                                ->segundoApellido($request->sape_acud)
                                ->orderBy('docu_acud')
                                ->orderBy('nomb_acud')
                                ->orderBy('pape_acud')
                                ->paginate();

        return view('acudientes.index', compact('acudientes'));
    }

    /**
     * Devuelve el listado de usuarios filtradom por documento o nombres.
     *
     * @return \Illuminate\Http\Response json
     */
    public function search(BusquedaRequest $request)
    {
        $request->validate();

        if ($request->ajax())
        {
            $acudientes = Acudiente::Search($request->sear_acud)
                                    ->select('id', 'tipo_docu', 'docu_acud', 'nomb_acud', 'pape_acud')
                                    ->orderBy('nomb_acud', 'asc')
                                    ->orderBy('pape_acud', 'asc')
                                    ->orderBy('docu_acud', 'asc')
                                    ->cursor();

            $acud_json = array();

            foreach ($acudientes as $acudiente)
            {
               $acud_json[] = array(
                    'id' => $acudiente->id,
                    'text' => "{$acudiente->tipo_docu} {$acudiente->docu_acud} &middot; {$acudiente->nomb_acud} {$acudiente->pape_acud}"
                );
            }

            return response()->json(['items' => $acud_json], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Acudiente  $acudiente
     * @return \Illuminate\Http\Response
     */
    public function show(Acudiente $acudiente)
    {
        return view('acudientes.show' , compact('acudiente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Acudiente  $acudiente
     * @return \Illuminate\Http\Response
     */
    public function edit(Acudiente $acudiente)
    {
        return view('acudientes.edit' , compact('acudiente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Acudiente  $acudiente
     * @return \Illuminate\Http\Response
     */
    public function update(AcudienteRequest $request, Acudiente $acudiente)
    {
        $request->validate();

        try
        {
            DB::beginTransaction();

            /**
             * Actualizar el usuario
             */
            $acudiente->user->update([
                'nombre' => trim("{$request->nomb_acud} {$request->pape_acud} {$request->sape_acud}"),
                'email' => $request->corr_acud,
            ]);

            /**
             * Actualizar el acudiente
             */
            $acudiente->update($request->all());

            DB::commit();

            toast('¡El acudiente ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('acudientes.show', $acudiente->id);

        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el acudiente!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            toast('¡Se ha producido un error al actualizar el acudiente!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Acudiente  $acudiente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acudiente $acudiente)
    {
        //
    }
}
