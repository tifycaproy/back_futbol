<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JugadoresFB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadoresfb', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 60);
            $table->timestamp('fecha_nacimiento');
            $table->string('nacionalidad', 60);
            $table->string('n_camiseta', 2);
            $table->string('posicion', 40);
            $table->string('peso', 10);
            $table->string('estatura', 10);
            $table->string('foto', 20);
            $table->string('banner', 20);
            $table->string('instagram', 60);
            $table->boolean('activo');
            $table->integer('calendario_id')->default(0)->index();
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
        Schema::dropIfExists('jugadoresfb');
    }
}
