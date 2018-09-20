<?php

use App\Estudiante;
use App\Implemento;
use Faker\Generator as Faker;

$factory->define(App\EstudianteImplemento::class, function (Faker $faker)
{
    return [
    	'cant_util' 	=> $faker->randomNumber(2),
    	'estudiante_id' => Estudiante::all()->random()->id,
    	'implemento_id' => Implemento::all()->random()->id,

    ];
});
