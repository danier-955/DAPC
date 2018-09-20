<?php

use App\Grado;
use App\Area;
use App\Docente;
use Faker\Generator as Faker;

$factory->define(App\Asignatura::class, function (Faker $faker) {
    return [
        'nomb_asig'  => $faker->lastName,
        'peso_asig'  =>$faker->randomNumber(1),
        'log1_asig'  => $faker->text, 
        'log2_asig'  => $faker->text, 
        'log3_asig'  => $faker->text,
        'log4_asig'  => $faker->text,
        'area_id'	 => Area::all()->random()->id, 
        'docente_id' => Docente::all()->random()->id,
        'grado_id'   => Grado::all()->random()->id,
    ];
});
