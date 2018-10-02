<?php

use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker)
{
    return [
        'nomb_area' => $faker->unique()->text(30),
        'desc_area' => $faker->text,
    ];
});
