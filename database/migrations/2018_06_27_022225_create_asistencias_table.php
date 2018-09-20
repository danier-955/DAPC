<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->boolean('valo_asis')->unsigned();
            $table->boolean('peri_asis')->unsigned();
            $table->date('fech_asis');
            $table->string('moti_fall', 100)->nullable();
            $table->char('asignatura_id', 36)->index();
            $table->char('estudiante_id', 36)->index();
            $table->timestamps();

            $table->foreign('asignatura_id')->references('id')->on('asignaturas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')
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
        Schema::dropIfExists('asistencias');
    }
}
