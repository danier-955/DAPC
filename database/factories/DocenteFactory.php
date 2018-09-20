<?php

use App\Docente;
use App\Empleado;
use App\Role;
use App\User;
use Facades\App\Facades\Estado;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\SpecialRole;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->define(Docente::class, function (Faker $faker)
{
    /**
     * Usuario
     */
	$user = factory(User::class, Estado::activo())->create();

    /**
     * Obtener rol
     */
    $role = Role::where('slug', SpecialRole::docente())->value('id');

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
        'docu_doce' => $faker->unique()->randomNumber(7),
        'nomb_doce' => $nombres[0],
        'pape_doce' => $nombres[1],
        'sape_doce' => $nombres[2],
        'sexo_doce' => $faker->randomElement(Sexo::indexados()),
        'dire_doce' => $faker->streetAddress,
        'barr_doce' => $faker->streetName,
        'corr_doce' => $user->email,
        'tele_doce' => $faker->randomNumber(7),
        'titu_doce' => $faker->jobTitle,
        'espe_doce' => implode(', ', $faker->sentences),
        'expe_doce' => $faker->text,
        'obse_doce' => $faker->text,
        'empleado_id' => $empleado->id,
        'user_id' => $user->id,
    ];
});