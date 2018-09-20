<?php

use Webpatser\Uuid\Uuid;
use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker) {
    return [
    	'id'        => Uuid::generate()->string,
        'nomb_area' => $faker->streetName,
        'desc_area' => $faker->text,
    ];
});
