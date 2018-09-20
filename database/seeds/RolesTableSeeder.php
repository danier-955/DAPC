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
	    		->toArray()
	    );
    }
}
