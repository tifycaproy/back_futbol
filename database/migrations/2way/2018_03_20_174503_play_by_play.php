<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlayByPlay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playbyplay', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calendario_id')->index();
            $table->integer('jugador_id')->index();
            $table->enum('actividad', ['Entra', 'Sale', 'Gol', 'Tarjeta Amarilla', 'Tarjeta Roja', 'Lesionado']);
            $table->unsignedinteger('minuto');
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
        //
    }
}
