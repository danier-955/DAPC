<?php

use App\Inventario;

use Illuminate\Database\Seeder;

class InventariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Inventario::class, 20)->create();
    }
}
