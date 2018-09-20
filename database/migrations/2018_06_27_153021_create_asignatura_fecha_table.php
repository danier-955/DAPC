<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturaFechaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignatura_fecha', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->json('fech_nota');
            $table->boolean('peri_nota')->unsigned();
            $table->text('moti_nota', 250);
            $table->boolean('tipo_nota')->unsigned()->default(TipoNota::regular());
            $table->char('asignatura_id', 36)->index();
            $table->char('fecha_id', 36)->index();
            $table->timestamps();

            $table->foreign('asignatura_id')->references('id')->on('asignaturas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fecha_id')->references('id')->on('fechas')
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
        Schema::dropIfExists('asignatura_fecha');
    }
}
