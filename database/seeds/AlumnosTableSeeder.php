<?php

use App\Alumno;
use App\Programa;
use Illuminate\Database\Seeder;

class AlumnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Alumno::class, 40)->create()->each(function ($alumno)
        {
        	$alumno->programas()->sync(Programa::all()->random(3)->pluck('id'));
        });
    }
}
