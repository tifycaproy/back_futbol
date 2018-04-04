<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChatReporte extends Migration
{
    public function up()
    {
        Schema::create('chat_reporte', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('set null');
            $table->integer('usuario_reportado')->unsigned()->nullable();
            $table->foreign('usuario_reportado')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('set null');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_reporte');
    }
}
