<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoticiasOld extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias_old', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link', 300);
            $table->string('titulo', 100);
            $table->mediumtext('descripcion');
            $table->timestamp('fecha')->index('fecha');
            $table->boolean('active')->DEFAULT('1');
            $table->string('foto', 20);
            $table->boolean('aparecetimelineppal')->DEFAULT('1');
            $table->boolean('destacada')->DEFAULT('0')->index();
            $table->enum('tipo', ['Normal', 'Video', 'Infografia', 'Galeria', 'Stat'])->default('Normal');
            $table->integer('aparevetimelinemonumentales')->default('1');
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
