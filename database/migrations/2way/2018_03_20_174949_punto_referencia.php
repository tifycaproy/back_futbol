<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PuntoReferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_referencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cordx');
            $table->string('cordy');
            $table->string('descripcion');
            $table->string('nombre');
            $table->string('ciudad');
            $table->string('pais');
            $table->string('direccion');
            $table->timestamp('hora_evento')->nullable();
            $table->enum('icono', ['bar-rest', 'cc', 'estadio', 'hotel', 'tienda']);
            $table->timestamps();
            $table->timestamp('deleted_at');
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
