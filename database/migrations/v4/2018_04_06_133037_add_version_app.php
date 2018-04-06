<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionApp extends Migration
{
    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('version_app');
        });
    }

    public function down()
    {
        //
    }
}
