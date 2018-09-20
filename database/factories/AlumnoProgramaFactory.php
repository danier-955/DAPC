<?php

use App\AlumnoPrograma;
use App\Alumno;
use App\Programa;
use Webpatser\Uuid\Uuid;
use Faker\Generator as Faker;

$factory->define(App\AlumnoPrograma::class, function (Faker $faker) {
    return [
    	'id'          => Uuid::generate()->string,
        'alumno_id'   => Alumno::all()->random()->id, 
        'programa_id'=> Programa::all()->random()->id,
    ];
});
