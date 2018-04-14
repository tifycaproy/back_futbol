<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alineacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alineacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calendario_id')->index('calendario_id_fk');
            $table->integer('jugadores_id')->index('jugadores_id_fk');
            $table->integer('posicion');
            $table->enum('estado', ['Titular', 'Suplente']);
            $table->integer('orden');
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
        Schema::dropIfExists('alineacion');
    }
}
