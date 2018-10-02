<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImplementoSubGradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('implemento_sub_grado', function (Blueprint $table)
        {
            $table->char('implemento_id', 36)->index();
            $table->char('sub_grado_id', 36)->index();
            $table->timestamps();

            $table->foreign('implemento_id')->references('id')->on('implementos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_grado_id')->references('id')->on('sub_grados')
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
        Schema::dropIfExists('implemento_sub_grado');
    }
}
