<?php

use App\Administrativo;
use Carbon\Carbon;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Jornada;
use Faker\Generator as Faker;

$factory->define(App\Evento::class, function (Faker $faker)
{
    $inic_even = Carbon::parse("{$faker->date()} {$faker->time()}");

    $administrativo = Administrativo::query()
                                    ->whereNotIn('carg_admi', [Cargo::secretaria()])
                                    ->get()
                                    ->random();

    return [
        'titu_even' => $faker->unique()->sentence,
        'foto_even' => '9utHY3eBbBEBZB0fzdgwPQlCCdZXzwJvwqAToV6R.jpg',
        'inic_even' => $inic_even,
        'fina_even' => $inic_even->addDays(7),
        'most_even' => $faker->numberBetween(0, 1),
        'cupo_even' => $faker->randomNumber(2),
        'jorn_even' => $administrativo->jorn_admi,
        'desc_even' => $faker->paragraphs(4, true),
        'administrativo_id' => $administrativo->id,
    ];
});
