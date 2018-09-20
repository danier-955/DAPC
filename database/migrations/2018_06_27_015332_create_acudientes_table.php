<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcudientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acudientes', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('tipo_docu', 4);
            $table->string('docu_acud', 10)->unique();
            $table->string('nomb_acud', 50);
            $table->string('pape_acud', 25);
            $table->string('sape_acud', 25)->nullable();
            $table->boolean('sexo_acud')->unsigned();
            $table->string('dire_acud', 50);
            $table->string('barr_acud', 50)->nullable();
            $table->string('corr_acud', 50)->unique();
            $table->string('tele_acud', 10);
            $table->string('prof_acud', 100)->nullable();
            $table->char('user_id', 36)->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('acudientes');
    }
}
