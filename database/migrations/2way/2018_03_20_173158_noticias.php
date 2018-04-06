<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Noticias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link', 300);
            $table->string('titulo', 100);
            $table->mediumtext('descripcion');
            $table->timestamp('fecha')->index();
            $table->boolean('active')->default('1');
            $table->string('foto', 20);
            $table->boolean('aparecetimelineppal')->default('1');
            $table->boolean('destacada')->default('0')->index('destacada');
            $table->enum('tipo', ['Normal', 'Video', 'Infografia', 'Galeria', 'Stat'])->default('Normal');
            $table->integer('aparevetimelinemonumentales')->default('0');
            $table->boolean('aparecefutbolbase');
            $table->integer('id_calendario_noticia')->default('0')->index();
            $table->integer('id_calendario_noticiafb')->index();
            $table->integer('id_respuesta_noticia')->default(0)->index();
            $table->boolean('dorado')->default('0');
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
