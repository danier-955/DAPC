<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Limitar número de caracteres a 191 al correr la migración
         *
         */
        Schema::defaultStringLength(191);

         /**
         * Cambiar el nombre de la ruta en los controladores Resource
         *
         */
        Route::resourceVerbs([
            'create' => 'registrar',
            'edit' => 'editar',
        ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
