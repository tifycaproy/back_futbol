<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableReportePost extends Migration
{

    public function up()
    {
        Schema::create('muro_reporte', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tipo')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('muro_id')->unsigned()->nullable();
            $table->foreign('muro_id')->references('id')->on('muro')->onUpdate('cascade')->onDelete('set null');
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('set null');
            $table->integer('comentario_id')->unsigned()->nullable();
            $table->foreign('comentario_id')->references('id')->on('muro_comentarios')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });  
    }


    public function down()
    {
        Schema::dropIfExists('muro_reporte');    
    }
}
