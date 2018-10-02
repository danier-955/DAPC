<?php

use App\Area;
use App\Docente;
use App\Grado;
use Faker\Generator as Faker;

$factory->define(App\Asignatura::class, function (Faker $faker)
{
    return [
        'nomb_asig'  => $faker->text(20),
        'peso_asig'  => $faker->randomNumber(2),
        'log1_asig'  => $faker->text,
        'log2_asig'  => $faker->text,
        'log3_asig'  => $faker->text,
        'log4_asig'  => $faker->text,
        'area_id'    => Area::all()->random()->id,
        'docente_id' => Docente::all()->random()->id,
        'grado_id'   => Grado::all()->random()->id,
    ];
});
