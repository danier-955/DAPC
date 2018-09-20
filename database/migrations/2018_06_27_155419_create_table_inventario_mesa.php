<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInventarioMesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_mesa', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->integer('cant_desc')->unsigned();
            $table->boolean('esta_desc')->unsigned()->default(Peticion::pendiente());
            $table->char('inventario_id', 36)->index();
            $table->char('mesa_id', 36)->index();
            $table->timestamps();

            $table->foreign('inventario_id')->references('id')->on('inventarios')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('inventario_mesa');
    }
}
