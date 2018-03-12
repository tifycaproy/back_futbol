<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlPopupInicial extends Migration
{

    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('url_popup_inicial');
            $table->integer('act_pop_inicial');
        });
    }
    public function down()
    {
        //
    }
}
