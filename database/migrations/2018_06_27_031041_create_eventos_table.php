<?php

use Facades\App\Facades\Jornada;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('titu_even', 100)->unique();
            $table->string('foto_even', 100)->nullable();
            $table->timestamp('inic_even')->nullable();
            $table->timestamp('fina_even')->nullable();
            $table->integer('cupo_even')->unsigned()->length(3);
            $table->boolean('most_even')->unsigned()->default(0);
            $table->boolean('jorn_even')->unsigned()->default(Jornada::todas());
            $table->text('desc_even', 1000);
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
        Schema::dropIfExists('eventos');
    }
}
