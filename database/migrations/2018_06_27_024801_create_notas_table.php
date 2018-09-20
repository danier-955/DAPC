<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('codi_nota', 76)->unique();
            $table->string('nota_per1', 6)->default(0);
            $table->string('nota_per2', 6)->default(0);
            $table->string('nota_per3', 6)->default(0);
            $table->string('nota_per4', 6)->default(0);
            $table->string('nota_def1', 6)->default(0);
            $table->string('nota_def2', 6)->default(0);
            $table->string('nota_def3', 6)->default(0);
            $table->string('nota_def4', 6)->default(0);
            $table->boolean('cali_per1')->unsigned()->default(0);
            $table->boolean('cali_per2')->unsigned()->default(0);
            $table->boolean('cali_per3')->unsigned()->default(0);
            $table->boolean('cali_per4')->unsigned()->default(0);
            $table->string('nota_rec1', 6)->default(0);
            $table->string('nota_rec2', 6)->default(0);
            $table->string('nota_rec3', 6)->default(0);
            $table->string('nota_rec4', 6)->default(0);
            $table->boolean('cali_rec1')->unsigned()->default(0);
            $table->boolean('cali_rec2')->unsigned()->default(0);
            $table->boolean('cali_rec3')->unsigned()->default(0);
            $table->boolean('cali_rec4')->unsigned()->default(0);
            $table->year('ano_nota', 4)->default();
            $table->char('asignatura_id', 36)->index();
            $table->char('estudiante_id', 36)->index();
            $table->timestamps();

            $table->foreign('asignatura_id')->references('id')->on('asignaturas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')
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
        Schema::dropIfExists('notas');
    }
}
