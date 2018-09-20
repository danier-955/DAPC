<?php

use App\AlumnoPrograma;
use Illuminate\Database\Seeder;

class AlumnoProgramaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AlumnoPrograma::class, 40)->create();
    }
}
