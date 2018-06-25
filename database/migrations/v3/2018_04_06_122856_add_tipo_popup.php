<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoPopup extends Migration
{
    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('tipo_popup');
        });
    }

    public function down()
    {
        //
    }
}
