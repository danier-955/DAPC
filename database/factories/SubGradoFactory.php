<?php

use App\Grado;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\SubGrado::class, function (Faker $faker)
{
    return [
        'abre_subg'	=> Str::upper($faker->randomLetter),
        'cant_estu'	=> $faker->randomNumber(2),
        'grado_id'	=> Grado::all()->random()->id,
    ];
});
