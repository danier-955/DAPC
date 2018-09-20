<?php

use App\Administrativo;
use Facades\App\Facades\Cargo;
use Illuminate\Database\Seeder;

class AdministrativosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/**
         * Administrador
         */
    	factory(Administrativo::class, Cargo::administrador())->create();

    	/**
         * Coordinador
         */
    	factory(Administrativo::class, Cargo::coordinador(), 3)->create();

    	/**
         * Secretaria
         */
    	factory(Administrativo::class, Cargo::secretaria(), 3)->create();
    }
}
