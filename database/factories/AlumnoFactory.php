<?php

use Facades\App\Facades\Sexo;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\Documento;
use Faker\Generator as Faker;

$factory->define(App\Alumno::class, function (Faker $faker)
{
    return [
        'tipo_docu' => $faker->randomElement(Documento::tipos()),
        'docu_alum' => $faker->unique()->randomNumber(7),
        'nomb_alum' => $faker->firstName,
        'pape_alum' => $faker->lastName,
        'sape_alum' => $faker->lastName,
        'sexo_alum' => $faker->randomElement(Sexo::indexados()),
        'fech_naci' => $faker->date(),
        'dire_alum' => $faker->streetAddress,
        'barr_alum' => $faker->streetName,
        'corr_alum' => $faker->email,
        'tele_alum' => $faker->randomNumber(7),
        'nomb_acud' => "{$faker->firstName} {$faker->lastName}",
        'pare_acud' => $faker->randomElement(Parentesco::indexados()),
        'obse_alum' => $faker->text,
    ];
});
