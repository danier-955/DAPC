<?php

use Faker\Generator as Faker;

$factory->define(App\Permission::class, function (Faker $faker)
{
    return [
    	'name' => $faker->unique()->sentence,
    	'slug' => $faker->unique()->word . '.' . $faker->word,
    	'description' => $faker->paragraph,
    ];
});
