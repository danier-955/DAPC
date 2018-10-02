<?php

use App\Administrativo;
use Carbon\Carbon;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Jornada;
use Faker\Generator as Faker;

$factory->define(App\Calendario::class, function (Faker $faker)
{
	$fech_inic = Carbon::parse("{$faker->date()} {$faker->time()}");

	$administrativo = Administrativo::query()
				                    ->whereNotIn('carg_admi', [Cargo::secretaria()])
				                    ->get()
				                    ->random();

    return [
        'titu_cale' => $faker->unique()->sentence,
        'fech_inic' => $fech_inic,
        'fech_fina' => $fech_inic->addDays(7),
        'jorn_cale' => $administrativo->jorn_admi,
        'desc_cale' => $faker->paragraphs(2, true),
        'administrativo_id' => $administrativo->id,
    ];
});
