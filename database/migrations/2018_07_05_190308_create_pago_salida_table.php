<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_salida', function (Blueprint $table)
        {
            $table->char('pago_id', 36)->index();
            $table->char('salida_id', 36)->index();
            $table->timestamps();

            $table->foreign('pago_id')->references('id')->on('pagos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('salida_id')->references('id')->on('salidas')
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
        Schema::dropIfExists('pago_salida');
    }
}
