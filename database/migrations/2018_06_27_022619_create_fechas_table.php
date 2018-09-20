<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->json('fech_not1');
            $table->json('fech_not2');
            $table->json('fech_not3');
            $table->json('fech_not4');
            $table->json('fech_rec1');
            $table->json('fech_rec2');
            $table->json('fech_rec3');
            $table->json('fech_rec4');
            $table->year('ano_fech')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fechas');
    }
}
