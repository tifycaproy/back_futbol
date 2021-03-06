<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionesDoradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funciones_doradas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');
            $table->boolean('solo_dorado');
            $table->integer('max_dorado');
            $table->integer('max_normal');
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
        Schema::dropIfExists('funciones_doradas');
    }
}
