<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuntoReferenciaImagenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_referencia_imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->text('imagen');
            $table->text('url');
            $table->integer('punto_referencia_id')->unsigned()->nullable();
            $table->foreign('punto_referencia_id')->references('id')->on('punto_referencia')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punto_referencia_imagen');    
    }
}
