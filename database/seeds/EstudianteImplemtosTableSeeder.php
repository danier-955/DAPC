<?php

use App\EstudianteImplemento;
use Illuminate\Database\Seeder;

class EstudianteImplemtosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
    	factory(EstudianteImplemento::class, 40)->create();
    }
}
