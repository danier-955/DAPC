<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentePracticanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docente_practicante', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->date('fech_segu');
            $table->char('hora_lleg', 8);
            $table->char('hora_sali', 8);
            $table->text('acti_real', 500);
            $table->integer('hora_cump')->unsigned()->length(3);
            $table->text('obse_segu', 500)->nullable();
            $table->char('docente_id', 36)->index();
            $table->char('practicante_id', 36)->index();
            $table->timestamps();

            $table->foreign('docente_id')->references('id')->on('docentes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('practicante_id')->references('id')->on('practicantes')
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
        Schema::dropIfExists('docente_practicante');
    }
}
