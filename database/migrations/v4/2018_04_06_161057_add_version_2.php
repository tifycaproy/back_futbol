<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersion2 extends Migration
{

    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('version_ios');
            $table->text('version_android');
        });
    }

    public function down()
    {
        //
    }
}
