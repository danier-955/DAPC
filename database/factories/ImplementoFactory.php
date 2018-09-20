<?php

use Faker\Generator as Faker;

$factory->define(App\Implemento::class, function (Faker $faker)
{
    return [
        'nomb_util' => $faker->unique()->text(30),
        'desc_util' => $faker->text(),
    ];
});
