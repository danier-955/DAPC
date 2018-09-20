<?php

use App\Role;
use App\User;
use Facades\App\Facades\Estado;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\Documento;
use Facades\App\Facades\SpecialRole;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->define(App\Acudiente::class, function (Faker $faker)
{
    /**
     * Usuario
     */
	$user = factory(User::class, Estado::activo())->create();

    /**
     * Obtener rol
     */
    $role = Role::where('slug', SpecialRole::acudiente())->value('id');

    /**
     * Asignar rol al usuario
     */
    $user->syncRoles([$role]);

    /**
     * Obtener nombres, primer y segundo apellido del usuario
     */
	$nombres = explode(' ', $user->nombre);

    return [
        'id'        => Uuid::generate()->string,
        'tipo_docu' => $faker->randomElement(Documento::tipos()),
        'docu_acud' => $faker->unique()->randomNumber(7),
        'nomb_acud' => $nombres[0],
        'pape_acud' => $nombres[1],
        'sape_acud' => $nombres[2],
        'sexo_acud' => $faker->randomElement(Sexo::indexados()),
        'dire_acud' => $faker->streetAddress,
        'barr_acud' => $faker->streetName,
        'corr_acud' => $user->email,
        'tele_acud' => $faker->randomNumber(7),
        'prof_acud' => $faker->streetName,
        'user_id' 	=> $user->id,
    ];

});
