<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativos', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('docu_admi', 10)->unique();
            $table->string('nomb_admi', 50);
            $table->string('pape_admi', 25);
            $table->string('sape_admi', 25)->nullable();
            $table->boolean('sexo_admi')->unsigned();
            $table->string('dire_admi', 50);
            $table->string('barr_admi', 50)->nullable();
            $table->string('corr_admi', 50)->unique();
            $table->string('tele_admi', 10)->nullable();
            $table->string('titu_admi', 100);
            $table->string('espe_admi', 250)->nullable();
            $table->text('expe_admi', 500)->nullable();
            $table->boolean('carg_admi')->unsigned();
            $table->boolean('jorn_admi')->unsigned();
            $table->text('obse_admi', 250)->nullable();
            $table->char('empleado_id', 36)->index();
            $table->char('user_id', 36)->index();
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('administrativos');
    }
}
