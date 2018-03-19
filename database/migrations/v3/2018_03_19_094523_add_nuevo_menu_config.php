<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNuevoMenuConfig extends Migration
{

    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('titulo_0_1');
            $table->text('sub_titulo_1_1');
            $table->text('sub_titulo_1_2');
            $table->text('sub_titulo_1_3');
            $table->text('sub_titulo_1_4');
            $table->text('sub_titulo_1_5');
            $table->text('titulo_0_2');
            $table->text('sub_titulo_2_1');
            $table->text('sub_titulo_2_2');
            $table->text('sub_titulo_2_3');
            $table->text('sub_titulo_2_4');
            $table->text('sub_titulo_2_5');
        });
    }
    public function down()
    {
        //
    }
}
