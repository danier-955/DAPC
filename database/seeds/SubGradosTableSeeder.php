<?php

use App\SubGrado;
use Illuminate\Database\Seeder;

class SubGradosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(SubGrado::class, 26)->create();
    }
}
