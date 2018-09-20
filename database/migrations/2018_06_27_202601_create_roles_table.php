<?php

use Facades\App\Facades\SpecialRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name', 250)->unique();
            $table->string('slug', 250)->unique();
            $table->text('description', 500)->nullable();
            $table->enum('special', SpecialRole::indexados())->nullable();
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
        Schema::dropIfExists('roles');
    }
}
