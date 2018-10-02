<?php

use App\Estudiante;
use Illuminate\Database\Seeder;

class EstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
    	factory(Estudiante::class, 100)->create();
    }
}
