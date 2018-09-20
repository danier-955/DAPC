<?php

use Facades\App\Facades\Jornada;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galerias', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('titu_gale', 100)->unique();
            $table->string('foto_gale', 100);
            $table->string('desc_gale', 250);
            $table->boolean('most_gale')->unsigned()->default(0);
            $table->boolean('jorn_gale')->unsigned()->default(Jornada::todas());
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
        Schema::dropIfExists('galerias');
    }
}
