<?php

use App\Docente;
use App\Practicante;
use App\Seguimiento;
use App\SubGrado;
use Illuminate\Database\Seeder;
// use Webpatser\Uuid\Uuid;

class PracticantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Factory::create();

    	factory(Practicante::class, 20)->create()->each(function ($practicante) // use ($faker)
    	{
    		$practicante->subGrados()->sync(SubGrado::all()->random()->id);

            factory(Seguimiento::class, 5)->create([
                'practicante_id' => $practicante->id,
            ]);

            // $seguimientos = array();

            // for ($i = 0; $i < 5; $i++)
            // {
            //     $practicante->docentes()->attach(Docente::all()->random()->id, [
            //         'id' => Uuid::generate()->string,
            //         'fech_segu' => $faker->date(),
            //         'hora_lleg' => $faker->time(),
            //         'hora_sali' => $faker->time(),
            //         'acti_real' => $faker->text,
            //         'hora_cump' => $faker->randomDigit,
            //         'obse_segu' => $faker->text,
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ]);
            // }
    	});
    }
}
