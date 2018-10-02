<?php

use App\Fecha;
use Illuminate\Database\Seeder;

class FechasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /**
       * Fecha año actual
       */
      $nowYear = now()->year;

      factory(Fecha::class)->create([
      	'fech_not1'	=> [
      		'fech_inic' => "{$nowYear}-03-01 00:00:00",
      		'fech_fina' => "{$nowYear}-03-15 23:59:00"
      	],
  			'fech_not2'	=> [
  				'fech_inic' => "{$nowYear}-06-01 00:00:00",
  				'fech_fina' => "{$nowYear}-06-15 23:59:00"
  			],
  			'fech_not3'	=> [
  				'fech_inic' => "{$nowYear}-09-01 00:00:00",
  				'fech_fina' => "{$nowYear}-09-15 23:59:00"
  			],
  			'fech_not4'	=> [
  				'fech_inic' => "{$nowYear}-11-15 00:00:00",
  				'fech_fina' => "{$nowYear}-11-30 23:59:00"
  			],
  			'fech_rec1'	=> [
  				'fech_inic' => "{$nowYear}-03-16 00:00:00",
  				'fech_fina' => "{$nowYear}-03-20 23:59:00"
  			],
  			'fech_rec2'	=> [
  				'fech_inic' => "{$nowYear}-06-16 00:00:00",
  				'fech_fina' => "{$nowYear}-06-20 23:59:00"
  			],
      	'fech_rec3'	=> [
    			'fech_inic' => "{$nowYear}-09-16 00:00:00",
    			'fech_fina' => "{$nowYear}-09-20 23:59:00"
    		],
      	'fech_rec4'	=> [
    			'fech_inic' => "{$nowYear}-12-01 00:00:00",
    			'fech_fina' => "{$nowYear}-12-05 23:59:00"
    		],
      	'ano_fech'	=> $nowYear,
      ]);

      factory(Fecha::class, 10)->create();
    }
}
