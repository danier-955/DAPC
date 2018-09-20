<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('titu_peti', 100);
            $table->date('fech_peti');
            $table->text('desc_peti', 500);
            $table->boolean('esta_peti')->unsigned()->default(Peticion::pendiente());
            $table->text('obse_apro', 500)->nullable();
            $table->char('docente_id', 36)->index();
            $table->char('sub_grado_id', 36)->index();
            $table->timestamps();

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
        Schema::dropIfExists('mesas');
    }
}
