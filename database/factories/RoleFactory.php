<?php

use Facades\App\Facades\SpecialRole;
use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker)
{
    return [
    	'name' => $faker->unique()->sentence,
    	'slug' => $faker->unique()->word,
    	'special' => SpecialRole::noAccess(),
        'description' => $faker->paragraph,
    ];
});
