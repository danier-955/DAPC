<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->integer('stoc_inve')->unsigned();
            $table->char('administrativo_id', 36)->index();
            $table->char('implemento_id', 36)->index();
            $table->timestamps();

            $table->foreign('administrativo_id')->references('id')->on('administrativos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('implemento_id')->references('id')->on('implementos')
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
        Schema::dropIfExists('inventarios');
    }
}
