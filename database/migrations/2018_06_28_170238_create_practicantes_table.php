<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practicantes', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('tipo_docu', 4);
            $table->string('docu_prac', 10)->unique();
            $table->string('nomb_prac', 50);
            $table->string('pape_prac', 25);
            $table->string('sape_prac', 25)->nullable();
            $table->boolean('sexo_prac')->unsigned();
            $table->string('dire_prac', 50);
            $table->string('barr_prac', 50)->nullable();
            $table->string('corr_prac', 50)->unique();
            $table->string('tele_prac', 10)->nullable();
            $table->string('padr_prac', 100)->nullable();
            $table->string('madr_prac', 100)->nullable();
            $table->string('cole_prov', 100);
            $table->string('seme_curs', 25);
            $table->integer('hora_paga')->unsigned()->length(3);
            $table->date('inic_prac');
            $table->date('fina_prac');
            $table->text('obse_prac', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practicantes');
    }
}
