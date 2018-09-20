<?php
use App\Galeria;
use Illuminate\Database\Seeder;

class GaleriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Galeria::class, 20)->create();
    }
}
