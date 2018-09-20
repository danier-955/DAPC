<?php

use App\Acudiente;
use Illuminate\Database\Seeder;

class AcudientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
    	factory(Acudiente::class, 20)->create();
    }
}
