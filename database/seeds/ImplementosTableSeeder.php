<?php

use App\SubGrado;
use App\Implemento;
use Illuminate\Database\Seeder;

class ImplementosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Implemento::class, 100)->create()->each(function ($implemento)
    	{
    		$implemento->subGrados()->sync(SubGrado::all()->random(5)->pluck('id'));
        });
    }
}
