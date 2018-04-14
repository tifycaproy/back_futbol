<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Configuracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipo_id')->index();
            $table->integer('calendario_convodados_id')->index();
            $table->integer('calendario_aplausos_id')->index();
            $table->integer('calendario_alineacion_id')->index();
            $table->string('url_tabla', 200);
            $table->string('url_simulador', 200);
            $table->string('url_juramento', 200);
            $table->string('url_livestream', 200);
            $table->string('url_tienda', 200);
            $table->string('url_estadisticas', 200);
            $table->string('url_academia', 200);
            $table->string('tit_1', 30)->default('PERFIL');
            $table->string('tit_1_1', 30)->default('HINCHA OFICIAL');
            $table->string('tit_1_2', 30)->default('INFO CUENTA');
            $table->string('tit_2', 30)->default('NOTICIAS');
            $table->string('tit_3', 30)->default('CALENDARIO');
            $table->string('tit_4', 30)->default('TABLA');
            $table->string('tit_4_1', 30)->default('TABLA');
            $table->string('tit_4_2', 30)->default('SIMULADOR');
            $table->string('tit_5', 30)->default('ESTADÍSTICAS');
            $table->string('tit_6', 30)->default('EQUIPO');
            $table->string('tit_6_1', 30)->default('NÓMINA');
            $table->string('tit_6_1_1', 30)->default('PERFIL JUGADOR');
            $table->string('tit_6_1_2', 30)->default('REDES SOCIALES');
            $table->string('tit_6_2', 30)->default('CONVOCADOS PARTIDOS');
            $table->string('tit_6_3', 30)->default('JUGADOR MÁS APLAUDIDO');
            $table->string('tit_6_3_1', 30)->default('ÚLTIMO PARTIDO');
            $table->string('tit_6_3_2', 30)->default('ACUMULADO');
            $table->string('tit_7', 30)->default('ALINEACIÓN');
            $table->string('tit_7_1', 30)->default('ALINEACIÓN OFICIAL');
            $table->string('tit_7_2', 30)->default('MI ONCE IDEAL');
            $table->string('tit_8', 30)->default('REALIDAD VIRTUAL');
            $table->string('tit_9', 30)->default('EN VIVO');
            $table->string('tit_10', 30)->default('TÚ ELIGES');
            $table->string('tit_10_1', 30)->default('VOTACIONES');
            $table->string('tit_10_2', 30)->default('RANKING');
            $table->string('tit_11', 30)->default('JUEGOS');
            $table->string('tit_11_1', 30)->default('POLLA MILLOS');
            $table->string('tit_11_1_1', 30)->default('INICIO');
            $table->string('tit_11_1_2', 30)->default('PREDICCIÓN');
            $table->string('tit_11_1_3', 30)->default('RESULTADOS');
            $table->string('tit_11_1_4', 30)->default('RANKING');
            $table->string('tit_12', 30)->default('ACADEMIA MILLONARIOS');
            $table->string('tit_13', 30)->default('TIENDA VIRTUAL');
            $table->string('tit_14', 30)->default('FÚTBOL BASE');
            $table->string('tit_14_1', 30)->default('NOTICIAS');
            $table->string('tit_14_2', 30)->default('EQUIPO');
            $table->string('tit_14_2_1', 30)->default('FÚTBOL BASE');
            $table->string('tit_14_2_2', 30)->default('PERFIL EQUIPO');
            $table->string('tit_14_3', 30)->default('CALENDARIO');
            $table->string('tit_15', 30)->default('NOTIFICACIONES');
            $table->string('tit_16', 30)->default('Muro y Chat');
            $table->string('tit_16_1', 30)->default('Muro Hincha');
            $table->string('tit_16_2', 30)->default('Muro');
            $table->string('tit_16_3', 30)->default('Chat');
            $table->string('tit_16_3_1', 30)->default('mensajes');
            $table->string('tit_16_3_2', 30)->default('grupos');
            $table->string('tit_16_3_3', 30)->default('amigos');
            $table->string('tit_16_3_4', 30)->default('solicitudes');
            $table->string('patrocinante', 20);
            $table->string('video_referidos', 200);
            $table->mediumtext('terminos_referidos');
            $table->string('url_imagen_beneficios_dorados');
            $table->string('footer_formulario_dorados');
            $table->string('texto_bienvenida_dorados');
            $table->string('video_de_bienvenida_dorados');
            $table->string('url_tyc_dorados');
            $table->string('url_popup_dorado');
            $table->string('url_popup_inicial');
            $table->integer('act_pop_inicial');
            $table->string('link_pop_inicial');
            $table->string('target_popup');
            $table->string('seccion_destino_popup');
            $table->string('id_partido_banner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracion');
    }
}
