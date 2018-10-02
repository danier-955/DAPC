<?php

use App\Inventario;
use App\Implemento;
use App\Administrativo;
use Faker\Generator as Faker;

$factory->define(App\Inventario::class, function (Faker $faker)
{
    return [
        'stoc_inve' => $faker->randomNumber(3),
        'administrativo_id' => Administrativo::all()->random()->id,
        'implemento_id' => Implemento::all()->random()->id,
    ];
});
