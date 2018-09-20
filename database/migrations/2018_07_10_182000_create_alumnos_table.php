<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('tipo_docu', 4);
            $table->string('docu_alum', 10)->unique();
            $table->string('nomb_alum', 50);
            $table->string('pape_alum', 25);
            $table->string('sape_alum', 25)->nullable();
            $table->boolean('sexo_alum')->unsigned();
            $table->date('fech_naci');
            $table->string('dire_alum', 50);
            $table->string('barr_alum', 50)->nullable();
            $table->string('corr_alum', 50)->unique();
            $table->string('tele_alum', 10)->nullable();
            $table->string('nomb_acud', 100);
            $table->string('pare_acud', 15);
            $table->text('obse_alum', 500)->nullable();
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
        Schema::dropIfExists('alumnos');
    }
}
