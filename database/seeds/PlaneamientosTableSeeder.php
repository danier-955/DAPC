<?php

use App\Planeamiento;
use Illuminate\Database\Seeder;

class PlaneamientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Planeamiento::class, 100)->create();
    }
}
