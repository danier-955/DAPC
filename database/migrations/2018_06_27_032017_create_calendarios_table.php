<?php

use Facades\App\Facades\Jornada;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendarios', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('titu_cale', 100)->unique();
            $table->datetime('fech_inic');
            $table->datetime('fech_fina');
            $table->text('desc_cale', 500);
            $table->text('fina_cale', 500)->nullable();
            $table->boolean('jorn_cale')->unsigned()->default(Jornada::todas());
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
        Schema::dropIfExists('calendarios');
    }
}
