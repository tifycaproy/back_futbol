<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OnceIdeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onceideal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->index();
            $table->integer('calendario_id')->index();
            $table->unsignedInteger('idjugador1')   ;
            $table->unsignedInteger('x1');
            $table->unsignedInteger('y1');
            $table->unsignedInteger('idjugador2');
            $table->unsignedInteger('x2');
            $table->unsignedInteger('y2');
            $table->unsignedInteger('idjugador3');
            $table->unsignedInteger('x3');
            $table->unsignedInteger('y3');
            $table->unsignedInteger('idjugador4');
            $table->unsignedInteger('x4');
            $table->unsignedInteger('y4');
            $table->unsignedInteger('idjugador5');
            $table->unsignedInteger('x5');
            $table->unsignedInteger('y5');
            $table->unsignedInteger('idjugador6');
            $table->unsignedInteger('x6');
            $table->unsignedInteger('y6');
            $table->unsignedInteger('idjugador7');
            $table->unsignedInteger('x7');
            $table->unsignedInteger('y7');
            $table->unsignedInteger('idjugador8');
            $table->unsignedInteger('x8');
            $table->unsignedInteger('y8');
            $table->unsignedInteger('idjugador9');
            $table->unsignedInteger('x9');
            $table->unsignedInteger('y9');
            $table->unsignedInteger('idjugador10');
            $table->unsignedInteger('x10');
            $table->unsignedInteger('y10');
            $table->unsignedInteger('idjugador11');
            $table->unsignedInteger('x11');
            $table->unsignedInteger('y11');
            $table->string('foto', 20);
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
