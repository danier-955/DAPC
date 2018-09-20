<?php

use App\Docente;
use App\Practicante;
use Faker\Generator as Faker;

$factory->define(App\Seguimiento::class, function (Faker $faker)
{
    return [
        'fech_segu' => $faker->date(),
        'hora_lleg' => $faker->time('h:i a'),
        'hora_sali' => $faker->time('h:i a'),
        'acti_real' => $faker->text,
        'hora_cump' => $faker->randomDigit,
        'obse_segu' => $faker->text,
        'docente_id' => Docente::all()->random()->id,
        // 'practicante_id' => Practicante::all()->random()->id,
    ];
});
