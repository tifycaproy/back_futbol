<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlPopupInicial extends Migration
{

    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('target_popup');
            $table->text('seccion_destino_popup');
        });
    }
    public function down()
    {
        //
    }
}
