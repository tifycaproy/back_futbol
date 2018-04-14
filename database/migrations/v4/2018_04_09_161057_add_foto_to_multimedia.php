<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFotoToMultimedia extends Migration
{
    public function up()
    {
        Schema::table('multimedia', function (Blueprint $table) {
            $table->text('foto');
        });
    }

    public function down()
    {
        //
    }
}
