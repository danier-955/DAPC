<?php

use Faker\Generator as Faker;

$factory->define(App\Fecha::class, function (Faker $faker)
{
   $maxYear = now()->subYear()->year;

   $maxDate = "{$maxYear}-12-31";

   return [
      'fech_not1' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_not2' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_not3' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_not4' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_rec1' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_rec2' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_rec3' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'fech_rec4' => [
         'fech_inic' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}",
         'fech_fina' => "{$faker->date('Y-m-d', $maxDate)} {$faker->time('h:i a', 'now')}"
      ],
      'ano_fech'  => $faker->unique()->year(),
    ];
});