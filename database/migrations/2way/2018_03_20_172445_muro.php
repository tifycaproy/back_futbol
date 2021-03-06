<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Muro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->index();
            $table->mediumtext('mensaje');
            $table->string('foto', 120)->nullable();
            $table->string('tipo_post');
            $table->string('thrumbnail')->nullable();
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
