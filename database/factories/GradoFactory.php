<?php

use Facades\App\Facades\Jornada;
use Faker\Generator as Faker;

$factory->define(App\Grado::class, function (Faker $faker)
{
	return [
        'nomb_grad' => $faker->unique()->text(30),
        'abre_grad' => str_pad($faker->unique()->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
        'jorn_grad' => $faker->randomElement(Jornada::indexados()),
    ];
});
