<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->bigInteger('tota_nomi')->unsigned();
            $table->bigInteger('tota_mora')->unsigned()->nullable();
            $table->boolean('pago_nomi')->unsigned();
            $table->boolean('quin_nomi')->unsigned()->nullable();
            $table->char('mes_nomi', 2);
            $table->year('ano_nomi');
            $table->char('pago_id', 36)->index();
            $table->timestamps();

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
        Schema::dropIfExists('nominas');
    }
}
