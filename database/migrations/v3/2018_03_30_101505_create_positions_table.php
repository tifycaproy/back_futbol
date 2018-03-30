<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posicions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos');
            $table->integer('copa_id')->unsigned()->nullable();
            $table->foreign('copa_id')->references('id')->on('copas')->onUpdate('cascade')->onDelete('set null');
            $table->integer('equipo_id')->unsigned()->nullable();
            $table->foreign('equipo_id')->references('id')->on('equipos')->onUpdate('cascade')->onDelete('set null');
            $table->integer('pt');
            $table->integer('pj');
            $table->integer('pg');
            $table->integer('pe');
            $table->integer('pp');
            $table->integer('gf');
            $table->integer('gc');
            $table->integer('dif');
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
        Schema::dropIfExists('positions');
    }
}
