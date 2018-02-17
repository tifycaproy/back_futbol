<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeccionesDoradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones_doradas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');
            $table->boolean('solo_dorado');
            $table->boolean('funciones_doradas');
            $table->text('mensaje_dorado');
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
        Schema::dropIfExists('secciones_doradas');
    }
}
