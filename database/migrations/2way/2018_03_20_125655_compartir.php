<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compartir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compartir', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->string('seccion', 20);
            $table->mediumtext('titulo');
            $table->mediumtext('descripcion');
            $table->string('footer1', 200)->default('Descarga la App Oficial de Millonarios FC');
            $table->string('footer2', 200)->default('¡Y disfruta de la experiencia del Ballet Azul en cualquier momento!');
            $table->string('foto', 20);
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
        Schema::dropIfExists('compartir');
    }
}
