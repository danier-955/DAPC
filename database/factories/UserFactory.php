<?php

use App\User;
use Facades\App\Facades\Estado;
use Faker\Generator as Faker;

$factory->defineAs(User::class, Estado::activo(), function (Faker $faker)
{
    return [
        'nombre' => "{$faker->firstName} {$faker->lastName} {$faker->lastName}",
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$3k.W1mh0TQUaGg2d7gDMdOtH9NmZU74v9LUSkekehZbx1EKJw32PK', // 'ipca2018',
        'estado' => Estado::activo(),
        'remember_token' => str_random(60),
    ];
});

$factory->defineAs(User::class, Estado::inactivo(), function (Faker $faker)
{
    return [
        'nombre' => "{$faker->firstName} {$faker->lastName} {$faker->lastName}",
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$3k.W1mh0TQUaGg2d7gDMdOtH9NmZU74v9LUSkekehZbx1EKJw32PK', // 'ipca2018',
        'estado' => Estado::inactivo(),
        'remember_token' => str_random(60),
    ];
});
