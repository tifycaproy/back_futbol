<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('apodo')->unique()->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('clave');
            $table->string('userID_facebook')->nullable();
            $table->string('userID_google')->nullable();
            $table->string('celular')->nullable();
            $table->string('pais')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->dateTime('fecha_nacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->string('foto')->nullable();
            $table->string('foto_redes')->nullable();
            $table->integer('ranking')->nullable();
            $table->string('pinseguridad')->nullable();
            $table->integer('puntos')->nullable();
            $table->integer('referido')->nullable();
            $table->enum('estatus', ['ACTIVO', 'PENDIENTE']);
            $table->dateTime('ultimo_ingreso')->nullable();
            $table->boolean('activo')->nullable();
            $table->boolean('dorado')->nullable();
            $table->boolean('abonado')->nullable();
            $table->boolean('socio')->nullable();
            $table->integer('chat_status')->nullable();
            $table->string('ci')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /*Schema::table('usuarios', function (Blueprint $table) {

        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
