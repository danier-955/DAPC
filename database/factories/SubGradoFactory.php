<?php

use App\Grado;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\SubGrado::class, function (Faker $faker)
{
    return [
        'abre_subg'	=> Str::upper($faker->unique()->randomLetter),
        'cant_estu'	=> $faker->randomNumber(2),
    ];
});
