<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoProgramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_programa', function (Blueprint $table)
        {
            $table->char('alumno_id', 36)->index();
            $table->char('programa_id', 36)->index();
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('alumnos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('programa_id')->references('id')->on('programas')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_programa');
    }
}
