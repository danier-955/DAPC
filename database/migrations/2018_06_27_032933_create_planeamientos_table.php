<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaneamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planeamientos', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('titu_plan', 100)->unique();
            $table->date('fech_plan');
            $table->text('desc_plan', 500);
            $table->string('docu_plan', 100)->nullable();
            $table->char('docente_id', 36)->index();
            $table->timestamps();

            $table->foreign('docente_id')->references('id')->on('docentes')
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
        Schema::dropIfExists('planeamientos');
    }
}
