<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_pago', function (Blueprint $table)
        {
            $table->char('evento_id', 36)->index();
            $table->char('pago_id', 36)->index();
            $table->timestamps();

            $table->foreign('evento_id')->references('id')->on('eventos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pago_id')->references('id')->on('pagos')
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
        Schema::dropIfExists('evento_pago');
    }
}
