<?php

use App\Administrativo;
use Faker\Generator as Faker;

$factory->define(App\Programa::class, function (Faker $faker)
{
    return [
        'nomb_prog' => $faker->unique()->text(30),
        'desc_prog' => $faker->text,
        'administrativo_id' => Administrativo::all()->random()->id,
    ];
});
