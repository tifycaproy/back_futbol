<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDireccionFechaPuntoreferencia extends Migration
{

    public function up()
    {
        Schema::table('punto_referencia', function (Blueprint $table) {
            $table->text('direccion')->nullable();
            $table->dateTime('hora_evento')->nullable();
        });   
    }


    public function down()
    {
        //
    }
}
