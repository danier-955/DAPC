<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_grados', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->char('abre_subg', 1);
            $table->tinyInteger('cant_estu')->unsigned();
            $table->char('grado_id', 36)->index();
            $table->timestamps();

            $table->foreign('grado_id')->references('id')->on('grados')
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
        Schema::dropIfExists('sub_grados');
    }
}
