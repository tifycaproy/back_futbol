<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FuncionesDoradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funciones_doradas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('solo_dorado')->default(0);
            $table->integer('max_dorado');
            $table->integer('max_normal');
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
        Schema::dropIfExists('funciones_doradas');

    }
}
