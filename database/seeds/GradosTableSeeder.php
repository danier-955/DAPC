<?php
use App\Grado;
use App\SubGrado;
use Illuminate\Database\Seeder;

class GradosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Grado::class, 10)->create()->each(function ($grado)
        {
        	factory(SubGrado::class, 2)->create([
        		'grado_id'	=> $grado->id,
        	]);
        });
    }
}
