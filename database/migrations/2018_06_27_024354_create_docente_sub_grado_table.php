<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocenteSubGradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docente_sub_grado', function (Blueprint $table)
        {
            $table->char('docente_id', 36)->index();
            $table->char('sub_grado_id', 36)->index();

            $table->foreign('docente_id')->references('id')->on('docentes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_grado_id')->references('id')->on('sub_grados')
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
        Schema::dropIfExists('docente_sub_grado');
    }
}
