<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BackupNoticias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backup_noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link', 300);
            $table->string('titulo', 100);
            $table->mediumtext('descripcion');
            $table->timestamp('fecha')->index()->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('active')->DEFAULT('1');
            $table->string('foto', 20);
            $table->boolean('aparecetimelineppal')->DEFAULT('1');
            $table->boolean('destacada')->DEFAULT('0')->index();
            $table->enum('tipo', ['Normal', 'Video', 'Infografia', 'Galeria', 'Stat'])->DEFAULT('Normal');
            $table->integer('aparevetimelinemonumentales')->DEFAULT('0');
            $table->boolean('aparecefutbolbase');
            $table->integer('id_calendario_noticia')->DEFAULT('0')->index();
            $table->integer('id_calendario_noticiafb')->index();
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
        Schema::dropIfExists('backup_noticias');

    }
}
