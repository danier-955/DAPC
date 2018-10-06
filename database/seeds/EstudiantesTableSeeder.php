<?php

use App\Estudiante;
use App\Implemento;
use Webpatser\Uuid\Uuid;
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
    	factory(Estudiante::class, 100)->create()->each(function ($estudiante)
    	{
    		$implementos = Implemento::query()
    								->whereHas('subGrados', function ($query) use ($estudiante) {
    									return $query->where('id', $estudiante->sub_grado_id);
    								})
                                    ->get()
                                    ->random(5);

    		foreach ($implementos as $implemento)
    		{
	    		$estudiante->implementos()->save($implemento, [
	    			'id' => Uuid::generate()->string,
	    			'cant_util' => random_int(1, 10),
    				'ano_util' => now()->year,
	    		]);
    		}
    	});
    }
}
