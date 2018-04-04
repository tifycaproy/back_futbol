<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Banners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seccion', 20);
            $table->string('titulo', 100);
            $table->enum('target', ['Interno', 'Externo', 'Seccion']);
            $table->string('url', 200);
            $table->string('seccion_destino', 20);
            $table->string('foto', 20);
            $table->string('type');
            $table->string('partido');
            $table->string('partidofb');
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
        Schema::dropIfExists('banners');

    }
}
