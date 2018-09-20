<?php

namespace App\Providers;

use App\Observers\ModelObserver;
use Illuminate\Support\ServiceProvider;

class BitacoraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Listado de modelos que seran observados
         *
         */
        $models = [
            '\App\Acudiente',
            '\App\Administrativo',
            '\App\Alumno',
            '\App\Area',
            '\App\Asignatura',
            '\App\Asistencia',
            '\App\Calendario',
            '\App\Docente',
            '\App\Empleado',
            '\App\Estudiante',
            '\App\Evento',
            '\App\Fecha',
            '\App\Galeria',
            '\App\Grado',
            '\App\Implemento',
            '\App\Inventario',
            '\App\Mesa',
            '\App\Nomina',
            '\App\Nota',
            '\App\Pago',
            '\App\Permission',
            '\App\Planeamiento',
            '\App\Practicante',
            '\App\Role',
            '\App\Salida',
            '\App\Seguimiento',
            '\App\SubGrado',
            '\App\TipoEmpleado',
            '\App\User',
        ];

        /**
         * Ejecutar el observador para cada uno de los modelos
         *
         */
        foreach ($models as $model)
        {
            $model::observe(ModelObserver::class);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
