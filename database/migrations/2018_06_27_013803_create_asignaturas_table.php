<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nomb_asig', 50);
            $table->tinyInteger('peso_asig')->unsigned()->default(100);
            $table->text('log1_asig')->nullable();
            $table->text('log2_asig')->nullable();
            $table->text('log3_asig')->nullable();
            $table->text('log4_asig')->nullable();
            $table->char('area_id', 36)->index();
            $table->char('docente_id', 36)->index();
            $table->char('grado_id', 36)->index();
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on('docentes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')
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
        Schema::dropIfExists('asignaturas');
    }
}
