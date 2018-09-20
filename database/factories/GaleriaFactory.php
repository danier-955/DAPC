<?php

use App\Administrativo;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Jornada;
use Faker\Generator as Faker;

$factory->define(App\Galeria::class, function (Faker $faker)
{
	$administrativo = Administrativo::query()
			                    ->whereNotIn('carg_admi', [Cargo::secretaria()])
			                    ->get()
			                    ->random();

	return [
        'titu_gale' 		=> $faker->unique()->sentence,
        'foto_gale' 		=> '3chHY3eBbBEBZB0fzdgwPQlCCdZXzwJvwqAToV6R.jpg',
        'desc_gale' 		=> $faker->text(250),
        'most_gale' 		=> $faker->numberBetween(0, 1),
        'jorn_gale' 		=> $administrativo->jorn_admi,
        'administrativo_id' => $administrativo->id,
    ];
});
