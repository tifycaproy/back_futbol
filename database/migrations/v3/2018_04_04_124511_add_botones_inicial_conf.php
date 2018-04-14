<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBotonesInicialConf extends Migration
{

    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('boton_1_activo');
            $table->text('boton_1_texto');
            $table->text('boton_2_activo');
            $table->text('boton_2_texto');
        });
    }

    public function down()
    {
        //
    }
}
