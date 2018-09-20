<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nomb_prog', 100)->unique();
            $table->text('desc_prog', 250)->nullable();
            $table->char('administrativo_id', 36)->index();
            $table->timestamps();

            $table->foreign('administrativo_id')->references('id')->on('administrativos')
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
        Schema::dropIfExists('programas');
    }
}
