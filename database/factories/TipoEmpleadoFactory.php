<?php

use Faker\Generator as Faker;

$factory->define(App\TipoEmpleado::class, function (Faker $faker)
{
    return [
        'nomb_tipo' => $faker->unique()->jobTitle,
        'desc_tipo' => $faker->paragraph,
    ];
});
