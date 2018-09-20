<?php

use App\Acudiente;
use App\SubGrado;
use App\Role;
use App\User;
use Webpatser\Uuid\Uuid;
use Facades\App\Facades\Estado;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\Documento;
use Facades\App\Facades\TipoEstudiante;
use Faker\Generator as Faker;

$factory->define(App\Estudiante::class, function (Faker $faker)
{
    /**
     * Usuario
     */
	$user = factory(User::class, Estado::activo())->create();

    /**
     * Obtener rol
     */
    $role = Role::where('slug', SpecialRole::estudiante())->value('id');

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
        'docu_estu' => $faker->unique()->randomNumber(7),
        'nomb_estu' => $nombres[0],
        'pape_estu' => $nombres[1],
        'sape_estu' => $nombres[2],
        'sexo_estu' => $faker->randomElement(Sexo::indexados()),
        'fech_naci' => $faker->date(),
        'dire_estu' => $faker->streetAddress,
        'barr_estu' => $faker->streetName,
        'corr_estu' => $user->email,
        'padr_estu' => "{$faker->firstNameMale} {$faker->lastName}",
        'madr_estu' => "{$faker->firstNameFemale} {$faker->lastName}",
        'tele_estu' => $faker->randomNumber(7),
        'pare_acud' => $faker->randomElement(Parentesco::indexados()),
        'cole_prov' => $faker->streetName,
        'eps_estu' => $faker->streetName,
        'copi_docu' => str_random(30) . '.pdf',
        'copi_grad' => str_random(30) . '.pdf',
        'tipo_estu' => $faker->randomElement(TipoEstudiante::indexados()),
        'carn_vacu' => str_random(30) . '.pdf',
        'foto_estu' => 'puhxJXDSVRKijli6B8UGCGT3F7JF0qU900lz1VPr.jpg',
        'fech_reti' => $faker->date(),
        'fech_grad' => $faker->date(),
        'obse_estu' => $faker->text,
        'acudiente_id' => Acudiente::all()->random()->id,
        'sub_grado_id' => SubGrado::all()->random()->id,
        'user_id' => $user->id,
    ];

});