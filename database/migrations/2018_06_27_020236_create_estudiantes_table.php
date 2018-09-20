<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('tipo_docu', 4);
            $table->string('docu_estu', 10)->unique();
            $table->string('nomb_estu', 50);
            $table->string('pape_estu', 25);
            $table->string('sape_estu', 25)->nullable();
            $table->boolean('sexo_estu')->unsigned();
            $table->date('fech_naci');
            $table->string('dire_estu', 50);
            $table->string('barr_estu', 50)->nullable();
            $table->string('corr_estu', 50)->unique();
            $table->string('tele_estu', 10)->nullable();
            $table->string('padr_estu', 100)->nullable();
            $table->string('madr_estu', 100)->nullable();
            $table->string('pare_acud', 15);
            $table->string('cole_prov', 100)->nullable();
            $table->string('eps_estu', 100);
            $table->string('copi_docu', 100);
            $table->string('copi_grad', 100)->nullable();
            $table->boolean('tipo_estu')->unsigned()->default(TipoEstudiante::regular());
            $table->string('carn_vacu', 100)->nullable();
            $table->string('foto_estu', 100);
            $table->date('fech_reti')->nullable();
            $table->date('fech_grad')->nullable();
            $table->text('obse_estu', 500)->nullable();
            $table->char('acudiente_id', 36)->index();
            $table->char('sub_grado_id', 36)->index();
            $table->char('user_id', 36)->index();
            $table->timestamps();

            $table->foreign('acudiente_id')->references('id')->on('acudientes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_grado_id')->references('id')->on('sub_grados')
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
        Schema::dropIfExists('estudiantes');
    }
}
