<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EncuestasRespuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas_respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('encuesta_id')->index();
            $table->string('respuesta', 200);
            $table->string('foto', 20);
            $table->string('banner', 20);
            $table->string('miniatura', 20);
            $table->integer('votos')->default(0);
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
        Schema::dropIfExists('encuestas_respuestas');

    }
}
