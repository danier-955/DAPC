<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->timestamp('fech_sali');
            $table->timestamp('fech_regr');
            $table->string('luga_dest', 100);
            $table->char('mesa_id', 36)->index();
            $table->timestamps();

            $table->foreign('mesa_id')->references('id')->on('mesas')
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
        Schema::dropIfExists('salidas');
    }
}
