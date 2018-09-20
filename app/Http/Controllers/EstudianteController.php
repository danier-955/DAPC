<?php

namespace App\Http\Controllers;

use App\Acudiente;
use App\Estudiante;
use App\EstudianteImplemento;
use App\Implemento;
use App\User;
use App\Role;
use App\SubGrado;
use App\Grado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\TipoEstudiante;
use Facades\App\Facades\Documento;
use Facades\App\Facades\Estado;
use App\Http\Requests\AcudienteEstudianteRequest;
use App\Http\Requests\EstudianteRequest;
use App\Http\Requests\BusquedaRequest;
use Facades\App\Facades\SpecialRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Encryption\DecryptException;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('has.permission:estudiantes.index')->only(['index']);
        $this->middleware('has.permission:estudiantes.show')->only(['show']);
        $this->middleware('has.permission:estudiantes.create')->only(['create', 'store']);
        $this->middleware('has.permission:estudiantes.edit')->only(['edit', 'update']);
    }


    public function index(BusquedaRequest $request)
    { 
        $grados = Grado::with('subGrados')
            ->orderBy('abre_grad')
            ->get();

        $estudiantes = Estudiante::query()
                            ->documento($request->docu_estu)
                            ->nombre($request->nomb_estu)
                            ->primerApellido($request->pape_estu)
                            ->subGrado($request->sub_grado_id)
                            ->orderBy('nomb_estu')
                            ->orderBy('pape_estu')
                            ->orderBy('sub_grado_id')
                            ->paginate();

        return view('estudiantes.index', compact('estudiantes','grados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {                      
       $grados = Grado::with('subGrados')
            ->orderBy('abre_grad')
            ->get();
         return view('estudiantes.create',compact('grados')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcudienteEstudianteRequest $request)
    {
        $request->validate();
        try 
        {
            DB::beginTransaction();

            /**
             * Registrar el acudiente
             */

             if ($request->has('acudiente_id'))
            {
                $acudiente_id = $request->acudiente_id;
            }
            else
            {   

                /**
                 * Registrar el usuario acudiente
                 */
                $usuarioAcudiente = User::create([
                    'nombre' => trim("{$request->nomb_acud} {$request->pape_acud} {$request->sape_acud}"),
                    'email' => $request->corr_acud,
                    'password' => $request->docu_acud,
                    'estado' => Estado::activo(),
                ]);
                /**
                 * Obtener el rol acudiente
                 */
                $roleAcudiente = Role::where('slug', SpecialRole::acudiente())->first();
                /**
                 * Asignar rol al usuario acudiente
                 */
                $usuarioAcudiente->syncRoles([$roleAcudiente->id]);

                $request->merge([
                    'user_id' => $usuarioAcudiente->id,
                ]); 

                $acudiente = Acudiente::create($request->only('tipo_docu', 'docu_acud', 'nomb_acud', 'pape_acud', 'sape_acud', 'sexo_acud', 'dire_acud', 'barr_acud', 'corr_acud', 'tele_acud', 'prof_acud', 'user_id'));
                
                $acudiente_id = $acudiente->id;
            }


            /**
             * Registrar el usuario estudiante
             */

            $usuarioEstudiante = User::create([
                'nombre' => trim("{$request->nomb_estu} {$request->pape_estu} {$request->sape_estu}"),
                'email' => $request->corr_estu,
                'password' => $request->docu_estu,
                'estado' => Estado::activo(),
            ]);
            /**
             * Obtener el rol estudiante
             */
            $roleEstudiante = Role::where('slug', SpecialRole::estudiante())->first();

            /**
             * Asignar rol al usuario estudiante
             */
            $usuarioEstudiante->syncRoles([$roleEstudiante->id]);
            
            /**
             * Registrar el estudiante
             */
            $estudiante = new Estudiante;
            $estudiante->tipo_docu = $request->tipo_docu_estu;
            $estudiante->docu_estu = $request->docu_estu;
            $estudiante->nomb_estu = $request->nomb_estu;
            $estudiante->pape_estu = $request->pape_estu;
            $estudiante->sape_estu = $request->sape_estu;
            $estudiante->sexo_estu = $request->sexo_estu;
            $estudiante->fech_naci = $request->fech_naci;
            $estudiante->dire_estu = $request->dire_estu;
            $estudiante->barr_estu = $request->barr_estu;
            $estudiante->corr_estu = $request->corr_estu;
            $estudiante->tele_estu = $request->tele_estu;
            $estudiante->padr_estu = $request->padr_estu;
            $estudiante->madr_estu = $request->madr_estu;
            $estudiante->pare_acud = $request->pare_acud;
            $estudiante->cole_prov = $request->cole_prov;
            $estudiante->eps_estu  = $request->eps_estu;
            $estudiante->copi_docu = $request->file('copi_docu')->store('', 'estudiante');
            $estudiante->copi_grad = $request->file('copi_grad')->store('', 'estudiante');
            $estudiante->tipo_estu = $request->tipo_estu;
            $estudiante->carn_vacu = $request->file('carn_vacu')->store('', 'estudiante');
            $estudiante->foto_estu = $request->file('foto_estu')->store('', 'estudiante.foto');
            $estudiante->obse_estu = $request->obse_estu;
            $estudiante->acudiente_id = $acudiente_id;
            $estudiante->sub_grado_id = $request->sub_grado_id; 
            $estudiante->user_id = $usuarioEstudiante->id;
            $estudiante->save();
            
            DB::commit();

            toast('¡El Alumno y Acudiente ha sido registrado correctamente!', 'success', 'top-right');

            return redirect()->route('estudiantes.show', $estudiante->id);

        } 
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e)
        {
            DB::rollback();
            dd($e->getMessage());

            toast('¡Se ha producido un error al registrar el Alumno y Acudiente!', 'error', 'top-right');

            return redirect()->back()->withInput();

        }
        catch (\Exception $e) 
        {
            DB::rollback();

            toast('¡Se ha producido un error al registrar el Alumno y Acudiente!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        // Opcion 2 para traer relacion en una sola consulta
        $estudiante->load('subGrado.grado');

        $utiles = EstudianteImplemento::query()
                                    ->where('estudiante_id', $estudiante->id)
                                    ->orderByDesc('created_at')
                                    ->paginate();
        return view('estudiantes.show', compact('estudiante','utiles'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        $estudiante->load('subGrado.grado');

        $implementos = Implemento::query()
                        ->subGrado($estudiante->sub_grado_id)
                        ->orderby('nomb_util')
                        ->get();

        $utiles = EstudianteImplemento::query()
                                ->where('estudiante_id', $estudiante->id)
                                ->orderByDesc('created_at')
                                ->cursor();

         $grados = Grado::query()
                        ->with('subGrados')
                        ->orderBy('abre_grad')
                        ->orderBy('jorn_grad')
                        ->get();
        return view('estudiantes.edit', compact('estudiante','grados','implementos','utiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(EstudianteRequest $request, Estudiante $estudiante)
    {
        $request->validate();

        try
        {
            $estudiante->tipo_docu = $request->tipo_docu;
            $estudiante->docu_estu = $request->docu_estu;
            $estudiante->nomb_estu = $request->nomb_estu;
            $estudiante->pape_estu = $request->pape_estu;
            $estudiante->sape_estu = $request->sape_estu;
            $estudiante->sexo_estu = $request->sexo_estu;
            $estudiante->fech_naci = $request->fech_naci;
            $estudiante->dire_estu = $request->dire_estu;
            $estudiante->barr_estu = $request->barr_estu;
            $estudiante->corr_estu = $request->corr_estu;
            $estudiante->tele_estu = $request->tele_estu;
            $estudiante->padr_estu = $request->padr_estu;
            $estudiante->madr_estu = $request->madr_estu;
            $estudiante->pare_acud = $request->pare_acud;
            $estudiante->cole_prov = $request->cole_prov;
            $estudiante->eps_estu  = $request->eps_estu;
            $estudiante->tipo_estu = $request->tipo_estu;

            if ($request->hasFile('foto_estu'))
            {
                $this->deleteFile('estudiante.foto', $estudiante->foto_estu);  // No ves que aqui se le manda el nombre del disco y el campo
                $estudiante->foto_estu = $request->file('foto_estu')->store('', 'estudiante.foto');
            }

            if ($request->hasFile('copi_docu'))
            {
                $this->deleteFile('estudiante', $estudiante->copi_docu); // No ves que aqui se le manda el nombre del disco y el campo
                $estudiante->copi_docu = $request->file('copi_docu')->store('', 'estudiante');
            
            }

             if ($request->hasFile('copi_grad'))
            {
                $this->deleteFile('estudiante', $estudiante->copi_grad); // No ves que aqui se le manda el nombre del disco y el campo
                $estudiante->copi_grad = $request->file('copi_grad')->store('', 'estudiante');
            }

             if ($request->hasFile('carn_vacu'))
            {
                $this->deleteFile('estudiante', $estudiante->carn_vacu); // No ves que aqui se le manda el nombre del disco y el campo   
                $estudiante->carn_vacu = $request->file('carn_vacu')->store('', 'estudiante');
            }

            $estudiante->obse_estu = $request->obse_estu;
            $estudiante->sub_grado_id = $request->sub_grado_id; 
            $estudiante->save();

            toast('¡El Estudiante ha sido actualizada correctamente!', 'success', 'top-right');

            return redirect()->route('estudiantes.show', $estudiante->id);
        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al actualizar la Estudiante!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
    
     /**
     * Download the specified resource.
     *
     * @param  \App\Documentos  $Documentos
     * @return \Illuminate\Http\Response
     */
    public function download(Estudiante $estudiante, $campo)
    {
        try
        {  
            $campo = decrypt($campo);
            $disco = 'estudiante';

            switch ($campo) 
            {
                case 'foto_estu':
                    $nombre = 'Fotografia';
                    $disco = 'estudiante.foto';
                    break;

                case 'copi_docu':
                    $nombre = 'Documento de identidad';
                    break;

                case 'copi_grad':
                    $nombre = 'Certificado de grado';
                    break;

                case 'carn_vacu':
                    $nombre = 'Carnet de vacunacion';
                    break;

                default:
                    $nombre = 'Sin titulo';
                    break;
            }

            if (! is_null($estudiante->{$campo}) && Storage::disk($disco)->exists($estudiante->{$campo}))
            {
                $titulo = $nombre . ' ' . $estudiante->docu_estu . '.' . File::extension(Storage::disk($disco)->url($estudiante->{$campo}));

                return Storage::disk($disco)->download($estudiante->{$campo}, $titulo);
            }
            else
            {
                toast('¡El archivo no existe!', 'error', 'top-right');

                return redirect()->back()->withInput();
            }

        }
        catch (\Exception $e)
        {
            toast('¡Se ha producido un error al descargar el archivo!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
        catch (DecryptException $e) 
        {
            toast('¡La ruta del archivo a descargar no es correcta!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }
    }

       /**
     * Elimina el documento del disco estudiante
     *
     * @param  string $campo
     * @return void
     */
    protected function deleteFile($disco, $campo) // recibe el nombre del disco y el campo a eliminar (foto_estu, copi_grad, etc..) funciona para todo
    {
        if (! is_null($campo) && Storage::disk($disco)->exists($campo))
        {
            Storage::disk($disco)->delete($campo);
        }
    }
}
