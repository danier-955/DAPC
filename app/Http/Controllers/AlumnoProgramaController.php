<?php

namespace App\Http\Controllers;

use App\AlumnoPrograma;
use App\Alumno;
use App\Programa;
use App\Http\Requests\AlumnoProgramasRequest;
use Illuminate\Http\Request;

class AlumnoProgramaController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:alumnosprogramas.index')->only(['index']);
        $this->middleware('has.permission:alumnosprogramas.create')->only(['create', 'store']);
        $this->middleware('has.permission:alumnosprogramas.edit')->only(['edit', 'update']);
        $this->middleware('has.permission:alumnosprogramas.destroy')->only(['destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumnos = Alumno::all();
        $programas = Programa::all();
        return view ('alumnosprogramas.create', compact('alumnos','programas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoProgramasRequest $request)
    {
        if ($request->ajax())
        {
            $request->validate();
            try
            {
                $alumnoPrograma = AlumnoPrograma::create($request->all());

                return response()->json([
                    'message' => '¡El útil han sido registrados correctamente!'
                ], 200);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    'message' => '¡Se ha producido un error al guardar el útil!'
                ], 400);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AlumnoPrograma  $alumnosprograma
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumnoPrograma $alumnosprograma)
    {
        $programas = Programa::all();
        return view('alumnosprogramas.edit' , compact ('alumnosprograma' , 'programas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AlumnoPrograma  $alumnosprograma
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoProgramasRequest $request, AlumnoPrograma $alumnosprograma)
    {
        $request->validate();

        try
        {
            $alumnosprograma->update($request->all());

            toast('¡El Programa ha sido actualizado correctamente!', 'success', 'top-right');

            return redirect()->route('alumnos.show', $alumnosprograma->alumno_id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar el Programa!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AlumnoPrograma  $alumnosprograma
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumnoPrograma $alumnosprograma)
    {
        try
        {
            $alumnosprograma->delete();

            toast('¡El Programa ha sido eliminada correctamente!', 'success', 'top-right');

            return redirect()->route('alumnos.show', $alumnosprograma->alumno_id);
        }
        catch (\Exception $e)
        {  
            dd($e->getMessage());
            toast('¡Se ha producido un error al eliminar El Programa!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }
}
