<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudianteNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_nomina', function (Blueprint $table)
        {
            $table->char('estudiante_id', 36)->index();
            $table->char('nomina_id', 36)->index();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nomina_id')->references('id')->on('nominas')
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
        Schema::dropIfExists('estudiante_nomina');
    }
}
