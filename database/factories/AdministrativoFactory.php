<?php

use App\Administrativo;
use App\Empleado;
use App\Role;
use App\User;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Estado;
use Facades\App\Facades\Jornada;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\SpecialRole;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->defineAs(Administrativo::class, Cargo::administrador(), function (Faker $faker)
{
    /**
     * Usuario
     */
	$user = factory(User::class, Estado::activo())->create([
        'email' => 'admin@ipca.test'
    ]);

    /**
     * Obtener rol
     */
    $role = Role::where('slug', SpecialRole::administrador())->value('id');

    /**
     * Asignar rol al usuario
     */
    $user->syncRoles([$role]);

    /**
     * Empleado
     */
	$empleado = factory(Empleado::class)->create();

    /**
     * Obtener nombres, primer y segundo apellido del usuario
     */
	$nombres = explode(' ', $user->nombre);

    return [
        'id'        => Uuid::generate()->string,
        'docu_admi' => $faker->unique()->randomNumber(7),
        'nomb_admi' => $nombres[0],
        'pape_admi' => $nombres[1],
        'sape_admi' => $nombres[2],
        'sexo_admi' => $faker->randomElement(Sexo::indexados()),
        'dire_admi' => $faker->streetAddress,
        'barr_admi' => $faker->streetName,
        'corr_admi' => $user->email,
        'tele_admi' => $faker->randomNumber(7),
        'titu_admi' => $faker->jobTitle,
        'espe_admi' => implode(', ', $faker->sentences),
        'expe_admi' => $faker->text,
        'carg_admi' => Cargo::administrador(),
        'jorn_admi' => Jornada::todas(),
        'obse_admi' => $faker->text,
        'empleado_id' => $empleado->id,
        'user_id' => $user->id,
    ];
});

$factory->defineAs(Administrativo::class, Cargo::coordinador(), function (Faker $faker)
{
    /**
     * Usuario
     */
	$user = factory(User::class, Estado::activo())->create();

    /**
     * Obtener rol
     */
    $role = Role::where('slug', SpecialRole::coordinador())->value('id');

    /**
     * Asignar rol al usuario
     */
    $user->syncRoles([$role]);

    /**
     * Empleado
     */
	$empleado = factory(Empleado::class)->create();

    /**
     * Obtener nombres, primer y segundo apellido del usuario
     */
	$nombres = explode(' ', $user->nombre);

    return [
        'id'        => Uuid::generate()->string,
        'docu_admi' => $faker->unique()->randomNumber(7),
        'nomb_admi' => $nombres[0],
        'pape_admi' => $nombres[1],
        'sape_admi' => $nombres[2],
        'sexo_admi' => $faker->randomElement(Sexo::indexados()),
        'dire_admi' => $faker->streetAddress,
        'barr_admi' => $faker->streetName,
        'corr_admi' => $user->email,
        'tele_admi' => $faker->randomNumber(7),
        'titu_admi' => $faker->jobTitle,
        'espe_admi' => implode(', ', $faker->sentences),
        'expe_admi' => $faker->text,
        'carg_admi' => Cargo::coordinador(),
        'jorn_admi' => $faker->randomElement(Jornada::indexados()),
        'obse_admi' => $faker->text,
        'empleado_id' => $empleado->id,
        'user_id' => $user->id,
    ];
});


$factory->defineAs(Administrativo::class, Cargo::secretaria(), function (Faker $faker)
{
    /**
     * Usuario
     */
	$user = factory(User::class, Estado::activo())->create();

    /**
     * Obtener rol
     */
    $role = Role::where('slug', SpecialRole::secretaria())->value('id');

    /**
     * Asignar rol al usuario
     */
    $user->syncRoles([$role]);

    /**
     * Empleado
     */
	$empleado = factory(Empleado::class)->create();

    /**
     * Obtener nombres, primer y segundo apellido del usuario
     */
	$nombres = explode(' ', $user->nombre);

    return [
        'id'        => Uuid::generate()->string,
        'docu_admi' => $faker->unique()->randomNumber(7),
        'nomb_admi' => $nombres[0],
        'pape_admi' => $nombres[1],
        'sape_admi' => $nombres[2],
        'sexo_admi' => $faker->randomElement(Sexo::indexados()),
        'dire_admi' => $faker->streetAddress,
        'barr_admi' => $faker->streetName,
        'corr_admi' => $user->email,
        'tele_admi' => $faker->randomNumber(7),
        'titu_admi' => $faker->jobTitle,
        'espe_admi' => implode(', ', $faker->sentences),
        'expe_admi' => $faker->text,
        'carg_admi' => Cargo::secretaria(),
        'jorn_admi' => $faker->randomElement(Jornada::indexados()),
        'obse_admi' => $faker->text,
        'empleado_id' => $empleado->id,
        'user_id' => $user->id,
    ];
});

