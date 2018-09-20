<?php

use App\Empleado;
use App\TipoEmpleado;
use Faker\Generator as Faker;

$factory->define(Empleado::class, function (Faker $faker)
{
    return [
        'fech_ingr' => $faker->date(),
        'obse_empl' => $faker->text,
        'tipo_empleado_id' => TipoEmpleado::all()->random()->id,
    ];
});