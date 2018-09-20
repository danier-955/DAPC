<?php

use App\Inventario;
use App\Implemento;
use App\Administrativo;
use Webpatser\Uuid\Uuid;
use Faker\Generator as Faker;

$factory->define(App\Inventario::class, function (Faker $faker) {
    return [
    	'id'        => Uuid::generate()->string,
        'stoc_inve' => $faker->randomNumber(2),
        'administrativo_id' => Administrativo::all()->random()->id,
        'implemento_id' => Implemento::all()->random()->id,
    ];
});
