<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudianteImplementoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_implemento', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->integer('cant_util')->unsigned()->length(3);
            $table->char('estudiante_id', 36)->index();
            $table->char('implemento_id', 36)->index();
            $table->timestamps();

            $table->foreign('implemento_id')->references('id')->on('implementos')
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
        Schema::dropIfExists('estudiante_implemento');
    }
}
