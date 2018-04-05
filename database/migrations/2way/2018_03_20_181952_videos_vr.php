<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideosVr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videovr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->mediumtext('descripcion');
            $table->string('foto', 20);
            $table->string('video', 200);
            $table->boolean('dorado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
