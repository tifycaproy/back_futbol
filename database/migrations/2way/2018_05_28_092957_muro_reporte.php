<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MuroReporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muro_reporte', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('descripcion');
            $table->integer('muro_id')->index();
            $table->integer('usuario_id')->index();
            $table->integer('comentario_id')->index();
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
        Schema::dropIfExists('muro_reporte');
    }
}
