<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoTipoEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_tipo_empleado', function (Blueprint $table)
        {
            $table->char('pago_id', 36)->index();
            $table->char('tipo_empleado_id', 36)->index();
            $table->timestamps();

            $table->foreign('pago_id')->references('id')->on('pagos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_empleado_id')->references('id')->on('tipo_empleados')
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
        Schema::dropIfExists('pago_tipo_empleado');
    }
}
