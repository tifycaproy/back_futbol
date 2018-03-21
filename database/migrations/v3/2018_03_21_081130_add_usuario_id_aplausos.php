<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuarioIdAplausos extends Migration
{

    public function up()
    {
        Schema::table('aplausos', function (Blueprint $table) {
            $table->text('usuario_id')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
