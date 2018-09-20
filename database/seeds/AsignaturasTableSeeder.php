<?php

use App\Asignatura;
use App\AsignaturaFecha;
use App\Fecha;
use Facades\App\Facades\Periodo;
use Facades\App\Facades\TipoNota;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class AsignaturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Asignatura::class, 50)->create()->each(function ($asignatura)
    	{
            factory(AsignaturaFecha::class, 5)->create([
                'asignatura_id' => $asignatura->id,
            ]);

            /*for ($i = 0; $i < 5; $i++)
            {
                $fecha = Fecha::all()->random();

                $fech_inic = now()->month(($i * 2) + 3)->year($fecha->ano_fech);

                $asignatura->fechas()->save($fecha, [
                    'id' => Uuid::generate()->string,
                    'fech_nota' => json_encode([
                        'fech_inic' => $fech_inic->format('Y-m-d H:m:s'),
                        'fech_fina' => $fech_inic->addHours(2)->format('Y-m-d H:m:s'),
                    ]),
                    'peri_nota' => array_random(Periodo::indexados()),
                    'moti_nota' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio corporis officiis quidem. Amet ducimus, rerum quidem deleniti doloribus magnam adipisci ipsa, odio dolores repudiandae mollitia id cumque, placeat, optio esse!',
                    'tipo_nota' => array_random(TipoNota::indexados()),
                ]);
            }*/
        });
    }
}
