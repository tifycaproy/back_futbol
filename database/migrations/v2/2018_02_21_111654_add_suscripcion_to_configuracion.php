<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuscripcionToConfiguracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('url_imagen_beneficios_dorados');
            $table->text('footer_formulario_dorados');
            $table->text('texto_bienvenida_dorados');
            $table->text('video_de_bienvenida_dorados');
            $table->text('url_tyc_dorados');
            $table->text('url_popup_dorado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            //
        });
    }
}
