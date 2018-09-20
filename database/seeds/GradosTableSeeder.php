<?php
use App\Grado;
use Illuminate\Database\Seeder;

class GradosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Grado::class, 12)->create();
    }
}
