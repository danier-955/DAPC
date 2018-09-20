<?php

use App\Grado;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nomb_grad', 50)->unique();
            $table->char('abre_grad', 2)->unique()->index();
            $table->boolean('jorn_grad')->unsigned()->default(Jornada::manana());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grados');
    }
}
