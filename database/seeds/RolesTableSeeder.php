<?php

use App\Role;
use App\Permission;
use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*
        |----------------------------------------------------------------------
        | Permisos
        |----------------------------------------------------------------------
        |
        */

        /**
    	 * Usuarios
    	 */
    	$usuarioPermissions = Permission::where('slug', 'LIKE', 'usuarios.%')->pluck('id', 'slug');

        /**
    	 * Administrativos
    	 */
    	$administrativoPermissions = Permission::where('slug', 'LIKE', 'administrativos.%')->pluck('id', 'slug');

        /**
    	 * Docentes
    	 */
    	$docentePermissions = Permission::where('slug', 'LIKE', 'docentes.%')->pluck('id', 'slug');

        /**
    	 * Planeamientos
    	 */
    	$planeamientoPermissions = Permission::where('slug', 'LIKE', 'planeamientos.%')->pluck('id', 'slug');

        /**
    	 * Practicantes
    	 */
    	$practicantePermissions = Permission::where('slug', 'LIKE', 'practicantes.%')->pluck('id', 'slug');

        /**
    	 * Seguimientos
    	 */
    	$seguimientoPermissions = Permission::where('slug', 'LIKE', 'seguimientos.%')->pluck('id', 'slug');

        /**
    	 * Galerias
    	 */
    	$galeriaPermissions = Permission::where('slug', 'LIKE', 'galerias.%')->pluck('id', 'slug');

        /**
    	 * Calendarios
    	 */
    	$calendarioPermissions = Permission::where('slug', 'LIKE', 'calendarios.%')->pluck('id', 'slug');

        /**
    	 * Eventos
    	 */
    	$eventoPermissions = Permission::where('slug', 'LIKE', 'eventos.%')->pluck('id', 'slug');

        /**
    	 * Areas
    	 */
    	$areaPermissions = Permission::where('slug', 'LIKE', 'areas.%')->pluck('id', 'slug');

        /**
    	 * Asignaturas
    	 */
    	$asignaturaPermissions = Permission::where('slug', 'LIKE', 'asignaturas.%')->pluck('id', 'slug');

        /**
    	 * Grados
    	 */
    	$gradoPermissions = Permission::where('slug', 'LIKE', 'grados.%')->pluck('id', 'slug');

        /**
    	 * Inventarios
    	 */
    	$inventarioPermissions = Permission::where('slug', 'LIKE', 'inventarios.%')->pluck('id', 'slug');

        /**
    	 * Implementos
    	 */
    	$implementoPermissions = Permission::where('slug', 'LIKE', 'implementos.%')->pluck('id', 'slug');

        /**
    	 * Estudiantes
    	 */
    	$estudiantePermissions = Permission::where('slug', 'LIKE', 'estudiantes.%')->pluck('id', 'slug');

        /**
    	 * Acudientes
    	 */
    	$acudientePermissions = Permission::where('slug', 'LIKE', 'acudientes.%')->pluck('id', 'slug');

        /**
    	 * Programas
    	 */
    	$programaPermissions = Permission::where('slug', 'LIKE', 'programas.%')->pluck('id', 'slug');

        /**
    	 * Alumnos
    	 */
    	$alumnoPermissions = Permission::where('slug', 'LIKE', 'alumnos.%')->pluck('id', 'slug');

        /**
    	 * Fechas
    	 */
    	$fechaPermissions = Permission::where('slug', 'LIKE', 'fechas.%')->pluck('id', 'slug');

        /**
    	 * Bitacoras
    	 */
    	$bitacoraPermissions = Permission::where('slug', 'LIKE', 'bitacoras.%')->pluck('id', 'slug');

        /**
    	 * Roles
    	 */
    	$rolePermissions = Permission::where('slug', 'LIKE', 'roles.%')->pluck('id', 'slug');

        /*
        |----------------------------------------------------------------------
        | Roles
        |----------------------------------------------------------------------
        |
        */

        /**
         * Administrador
         */
        $administrador = factory(Role::class)->create([
	    	'name' => 'Administrador',
	    	'slug' => SpecialRole::administrador(),
	    	'special' => SpecialRole::allAccess(),
	        'description' => 'Rol administrador con acceso total en toda la aplicación.',
	    ]);

        /**
         * Coordinador
         */
	    $coordinador = factory(Role::class)->create([
	    	'name' => 'Coordinador',
	    	'slug' => SpecialRole::coordinador(),
	    	'special' => SpecialRole::nullable(),
	        'description' => 'Rol coordinador sin acceso total en toda la aplicación.',
	    ]);

	    /**
	     * Asignar permisos al rol coordinador
	     */
	    $coordinador->syncPermissions(
	    	$usuarioPermissions->values()
	    		->merge($administrativoPermissions->except('administrativos.create', 'administrativos.edit')->values())
	    		->merge($docentePermissions->values())
	    		->merge($practicantePermissions->values())
	    		->merge($seguimientoPermissions->except('seguimientos.create', 'seguimientos.edit')->values())
	    		->merge($galeriaPermissions->values())
	    		->merge($calendarioPermissions->values())
	    		->merge($eventoPermissions->values())
	    		->merge($fechaPermissions->only('fechas.index', 'fechas.show')->values())
	    		->merge($areaPermissions->except('areas.create', 'areas.edit')->values())
	    		->merge($asignaturaPermissions->except('asignaturas.create', 'asignaturas.edit')->values())
	    		->merge($gradoPermissions->except('grados.create', 'grados.edit', 'grados.subgrados.create', 'grados.subgrados.edit')->values())
	    		->merge($inventarioPermissions->values())
	    		->merge($implementoPermissions->except('implementos.create', 'implementos.edit', 'implementos.destroy')->values())
	    		->merge($estudiantePermissions->values())
	    		->merge($acudientePermissions->values())
	    		->merge($programaPermissions->values())
	    		->merge($alumnoPermissions->values())
	    		->toArray()
	    );

	    /**
	     * Secretaria
	     */
	    $secretaria = factory(Role::class)->create([
	    	'name' => 'Secretaria',
	    	'slug' => SpecialRole::secretaria(),
	    	'special' => SpecialRole::nullable(),
	        'description' => 'Rol secretaria sin acceso total en toda la aplicación.',
	    ]);

	    /**
	     * Asignar permisos al rol secretaria
	     */
	    $secretaria->syncPermissions(
	    	$usuarioPermissions->values()
	    		->merge($administrativoPermissions->except('administrativos.create', 'administrativos.edit')->values())
	    		->merge($docentePermissions->except('docentes.create', 'docentes.edit')->values())
	    		->merge($practicantePermissions->values())
	    		->merge($seguimientoPermissions->except('seguimientos.create', 'seguimientos.edit')->values())
	    		->merge($galeriaPermissions->only('galerias.index')->values())
	    		->merge($calendarioPermissions->only('calendarios.index')->values())
	    		->merge($eventoPermissions->only('eventos.index', 'eventos.show')->values())
	    		->merge($fechaPermissions->only('fechas.index', 'fechas.show')->values())
	    		->merge($areaPermissions->except('areas.create', 'areas.edit')->values())
	    		->merge($asignaturaPermissions->except('asignaturas.create', 'asignaturas.edit')->values())
	    		->merge($gradoPermissions->except('grados.create', 'grados.edit', 'grados.subgrados.create', 'grados.subgrados.edit')->values())
	    		->merge($inventarioPermissions->values())
	    		->merge($implementoPermissions->except('implementos.create', 'implementos.edit', 'implementos.destroy')->values())
	    		->merge($estudiantePermissions->values())
	    		->merge($acudientePermissions->values())
	    		->merge($programaPermissions->except('programas.create', 'programas.edit', 'programas.destroy')->values())
	    		->merge($alumnoPermissions->except('alumnos.destroy')->values())
	    		->toArray()
	    );

	    /**
	     * Docente
	     */
	    $docente = factory(Role::class)->create([
	    	'name' => 'Docente',
	    	'slug' => SpecialRole::docente(),
	    	'special' => SpecialRole::nullable(),
	        'description' => 'Rol docente sin acceso total en toda la aplicación.',
	    ]);

	    /**
	     * Asignar permisos al rol docente
	     */
	    $docente->syncPermissions(
	    	$usuarioPermissions->values()
	    		->merge($docentePermissions->except('docentes.create', 'docentes.edit')->values())
	    		->merge($planeamientoPermissions->values())
	    		->merge($seguimientoPermissions->values())
	    		->merge($calendarioPermissions->only('calendarios.index')->values())
	    		->merge($fechaPermissions->only('fechas.index', 'fechas.show')->values())
	    		->merge($areaPermissions->except('areas.create', 'areas.edit')->values())
	    		->merge($asignaturaPermissions->except('asignaturas.create', 'asignaturas.edit')->values())
	    		->merge($gradoPermissions->except('grados.create', 'grados.edit', 'grados.subgrados.create', 'grados.subgrados.edit')->values())
	    		->merge($implementoPermissions->except('implementos.create', 'implementos.edit', 'implementos.destroy')->values())
	    		->merge($estudiantePermissions->except('estudiantes.create', 'estudiantes.edit', 'estudiantes.download', 'estudiantes.implementos.create', 'estudiantes.implementos.edit', 'estudiantes.implementos.destroy')->values())
	    		->merge($programaPermissions->except('programas.create', 'programas.edit', 'programas.destroy')->values())
	    		->merge($alumnoPermissions->except('alumnos.create', 'alumnos.edit', 'alumnos.destroy')->values())
	    		->toArray()
	    );

	    /**
	     * Estudiante
	     */
	    $estudiante = factory(Role::class)->create([
	    	'name' => 'Estudiante',
	    	'slug' => SpecialRole::estudiante(),
	    	'special' => SpecialRole::nullable(),
	        'description' => 'Rol estudiante sin acceso total en toda la aplicación.',
	    ]);

	    /**
	     * Asignar permisos al rol estudiante
	     */
	    $estudiante->syncPermissions(
	    	$usuarioPermissions->values()
	    		->merge($estudiantePermissions->except('estudiantes.create', 'estudiantes.edit', 'estudiantes.download', 'estudiantes.implementos.create', 'estudiantes.implementos.edit', 'estudiantes.implementos.destroy')->values())
	    		->merge($programaPermissions->except('programas.create', 'programas.edit', 'programas.destroy')->values())
	    		->toArray()
	    );

	    /**
	     * Acudiente
	     */
	    $acudiente = factory(Role::class)->create([
	    	'name' => 'Acudiente',
	    	'slug' => SpecialRole::acudiente(),
	    	'special' => SpecialRole::nullable(),
	        'description' => 'Rol acudiente sin acceso total en toda la aplicación.',
	    ]);

	    /**
	     * Asignar permisos al rol acudiente
	     */
	    $acudiente->syncPermissions(
	    	$usuarioPermissions->values()
	    		->merge($calendarioPermissions->only('calendarios.index')->values())
	    		->merge($estudiantePermissions->except('estudiantes.create', 'estudiantes.implementos.create', 'estudiantes.implementos.edit', 'estudiantes.implementos.destroy')->values())
	    		->merge($acudientePermissions->except('acudientes.edit')->values())
	    		->merge($programaPermissions->except('programas.create', 'programas.edit', 'programas.destroy')->values())
	    		->toArray()
	    );
    }
}
