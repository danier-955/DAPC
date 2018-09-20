<?php

use Facades\App\Facades\Documento;
use Facades\App\Facades\Sexo;
use Faker\Generator as Faker;

$factory->define(App\Practicante::class, function (Faker $faker)
{
    return [
    	'tipo_docu' => $faker->randomElement(Documento::tipos()),
        'docu_prac' => $faker->unique()->randomNumber(7),
        'nomb_prac' => $faker->firstName,
        'pape_prac' => $faker->lastName,
        'sape_prac' => $faker->lastName,
        'sexo_prac' => $faker->randomElement(Sexo::indexados()),
        'dire_prac' => $faker->streetAddress,
        'barr_prac' => $faker->streetName,
        'corr_prac' => $faker->unique()->safeEmail,
        'tele_prac' => $faker->randomNumber(7),
        'padr_prac' => "{$faker->firstNameMale} {$faker->lastName}",
        'madr_prac' => "{$faker->firstNameFemale} {$faker->lastName}",
        'cole_prov' => $faker->company,
        'seme_curs' => $faker->text(25),
        'hora_paga' => $faker->randomNumber(3),
        'inic_prac' => $faker->date(),
        'fina_prac' => $faker->date(),
        'obse_prac' => $faker->text,
    ];
});
