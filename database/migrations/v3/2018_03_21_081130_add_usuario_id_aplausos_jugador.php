<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuarioIdAplausosJugador extends Migration
{

    public function up()
    {
        Schema::table('aplausos', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('set null');
        });
    }

    public function down()
    {
        //
    }
}
