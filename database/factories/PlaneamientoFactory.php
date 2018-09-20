<?php

use App\Docente;
use Faker\Generator as Faker;

$factory->define(App\Planeamiento::class, function (Faker $faker)
{
    return [
        'titu_plan' => $faker->unique()->text(50),
        'fech_plan' => $faker->date(),
        'desc_plan' => $faker->text(500),
        'docu_plan' => str_random(30) . '.pdf',
        'docente_id' => Docente::all()->random()->id,
    ];
});
