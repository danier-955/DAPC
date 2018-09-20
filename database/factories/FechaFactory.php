<?php

use Faker\Generator as Faker;

$factory->define(App\Fecha::class, function (Faker $faker)
{
	return [
   		'fech_not1'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
   		'fech_not2'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
   		'fech_not3'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
   		'fech_not4'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
   		'fech_rec1'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
   		'fech_rec2'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
      'fech_rec3'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
      'fech_rec4'	=> ['fech_inic' => "{$faker->date()} {$faker->time()}", 'fech_fina' => "{$faker->date()} {$faker->time()}"],
      'ano_fech'	=> $faker->unique()->year(),
    ];
});
