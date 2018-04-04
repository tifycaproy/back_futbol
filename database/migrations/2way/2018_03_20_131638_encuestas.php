<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Encuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 250);
            $table->string('fecha_inicio', 45);
            $table->string('fecha_fin,45');
            $table->enum('tipo_voto', ['Unico', 'Múltiple Simple', 'Múltiple Libre'])->default('Unico');
            $table->enum('mostrar_resultados', ['Siempre', 'Solo si ya votó', 'Al finalizar la encuesta'])->default('Siempre');
            $table->boolean('activa')->default(0);
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
        Schema::dropIfExists('encuestas');
    }
}
