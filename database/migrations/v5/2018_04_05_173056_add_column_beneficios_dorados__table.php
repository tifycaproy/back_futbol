<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBeneficiosDoradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficios_dorados', function (Blueprint $table) {
            $table->char('titulo', 100);
            $table->text('link', 100);
            $table->timestamp('fecha');
            $table->tinyInteger('active');
            $table->enum('tipo', ['Normal', 'Video', 'Infografia', 'Galeria','Stat']);

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
