<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('docu_doce', 10)->unique();
            $table->string('nomb_doce', 50);
            $table->string('pape_doce', 25);
            $table->string('sape_doce', 25)->nullable();
            $table->boolean('sexo_doce')->unsigned();
            $table->string('dire_doce', 50);
            $table->string('barr_doce', 50)->nullable();
            $table->string('corr_doce', 50)->unique();
            $table->string('tele_doce', 10)->nullable();
            $table->string('titu_doce', 100);
            $table->string('espe_doce', 250)->nullable();
            $table->text('expe_doce', 500)->nullable();
            $table->text('obse_doce', 250)->nullable();
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
        Schema::dropIfExists('docentes');
    }
}
