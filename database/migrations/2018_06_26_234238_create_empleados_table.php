<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->date('fech_ingr');
            $table->text('obse_empl', 250)->nullable();
            $table->char('tipo_empleado_id', 36)->index();
            $table->timestamps();

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
        Schema::dropIfExists('empleados');
    }
}
