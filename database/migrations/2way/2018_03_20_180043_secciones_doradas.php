<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeccionesDoradas extends Migration
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
            $table->string('nombre');
            $table->boolean('solo_dorado');
            $table->boolean('funciones_doradas');
            $table->string('mensaje_dorado');
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

    }
}
