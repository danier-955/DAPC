<?php

use App\Acudiente;
use App\Administrativo;
use App\Docente;
use App\Estudiante;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'acudientes',
            'administrativos',
            'areas',
            'alumnos',
            'alumno_programa',
            'asignaturas',
            'bitacoras',
            'calendarios',
            'docentes',
            'docente_practicante',
            'empleados',
            'estudiantes',
            'estudiante_implemento',
            'eventos',
            'fechas',
            'galerias',
            'grados',
            'implementos',
            'inventarios',
            'permissions',
            'permission_role',
            'permission_user',
            'planeamientos',
            'practicantes',
            'practicante_sub_grado',
            'programas',
            'roles',
            'role_user',
            'sub_grados',
            'tipo_empleados',
            'users',
        ]);

        /**
         * Detener los eventos del modelo cuando se ejecutan los seeders
         */
        Acudiente::flushEventListeners();
        Administrativo::flushEventListeners();
        Docente::flushEventListeners();
        Estudiante::flushEventListeners();

        /*
         * Ejecutar los seeders
         */
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TipoEmpleadosTableSeeder::class);
        $this->call(DocentesTableSeeder::class);
        $this->call(PlaneamientosTableSeeder::class);
        $this->call(AdministrativosTableSeeder::class);
        $this->call(GradosTableSeeder::class);
        $this->call(SubGradosTableSeeder::class);
        $this->call(GaleriasTableSeeder::class);
        $this->call(PracticantesTableSeeder::class);
        $this->call(FechasTableSeeder::class);
        $this->call(BitacorasTableSeeder::class);
        $this->call(ImplementosTableSeeder::class);
        $this->call(AcudientesTableSeeder::class);
        $this->call(EstudiantesTableSeeder::class);
        $this->call(EventosTableSeeder::class);
        $this->call(CalendariosTableSeeder::class);
        $this->call(ProgramasSeeder::class);
        $this->call(AlumnosTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(AsignaturasTableSeeder::class);
        $this->call(InventariosTableSeeder::class);
    }

    /**
     * Vacias tablas antes de ejecutar las migraciones
     * @param array $tables
     * @return void
     */
    public function truncateTables(array $tables)
    {
        /*
	     * Desactivar las restricciones de asignación en masa.
	     */
    	Eloquent::unguard();

    	/*
         * Desactivamos la revisión de claves foráneas
         */
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        /*
         * Vaciar las tablas
         */
        foreach ($tables as $table)
        {
            DB::table($table)->truncate();
        }

        /*
         * Reactivamos la revisión de claves foráneas
         */
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
