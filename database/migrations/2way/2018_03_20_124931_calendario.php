<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Calendario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('copas_id')->index();
            $table->enum('estado', ['Pendiente', 'En Curso', 'Finalizado'])->DEFAULT('En Curso');
            $table->integer('equipos_1');
            $table->integer('goles_1');
            $table->integer('equipos_2');
            $table->integer('goles_2');
            $table->datetime('fecha')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('fecha_etapa');
            $table->string('estadio', 60);
            $table->string('video', 200);
            $table->string('info', 100);
            $table->integer('formacion_id')->index('formacion_id_fk');
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
        Schema::dropIfExists('calendario');
    }
}
