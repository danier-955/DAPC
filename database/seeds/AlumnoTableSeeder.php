<?php

use App\Alumno;
use Illuminate\Database\Seeder;

class AlumnoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Alumno::class, 40)->create();
    }
}
