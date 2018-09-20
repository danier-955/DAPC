<?php

use App\Fecha;
use Facades\App\Facades\Periodo;
use Facades\App\Facades\TipoNota;
use Faker\Generator as Faker;

$factory->define(App\AsignaturaFecha::class, function (Faker $faker)
{
	$fecha = Fecha::all()->random();

	$fech_inic = now()->month($faker->month())->year($fecha->ano_fech);

    return [
    	'fech_nota' => [
            'fech_inic' => $fech_inic->format('Y-m-d h:i a'),
            'fech_fina' => $fech_inic->addHours(2)->format('Y-m-d h:i a'),
        ],
		'peri_nota' => $faker->randomElement(Periodo::indexados()),
		'moti_nota' => $faker->text,
		'tipo_nota' => $faker->randomElement(TipoNota::indexados()),
		'fecha_id'	=> $fecha->id,
    ];
});
