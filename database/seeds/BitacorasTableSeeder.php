<?php

use App\Bitacora;
use Illuminate\Database\Seeder;

class BitacorasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bitacora::class, 30)->create();
    }
}
