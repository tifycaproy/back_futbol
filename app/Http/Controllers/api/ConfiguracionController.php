<?php

namespace App\Http\Controllers\api;

use App\Configuracion;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Multimedia;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $configuracion = Configuracion::first([
            'url_tabla', 'url_simulador', 'url_juramento', 'url_livestream', 'url_tienda', 'url_estadisticas', 'url_academia',
            'tit_1', 'tit_1_1', 'tit_1_2', 'tit_2', 'tit_3', 'tit_4', 'tit_4_1', 'tit_4_2', 'tit_5', 'tit_6', 'tit_6_1', 'tit_6_1_1', 'tit_6_1_2', 'tit_6_2', 'tit_6_3', 'tit_6_3_1', 'tit_6_3_2', 'tit_7',
            'tit_7_1', 'tit_7_2', 'tit_8', 'tit_9', 'tit_10', 'tit_10_1', 'tit_10_2', 'tit_11', 'tit_11_1', 'tit_11_1_1', 'tit_11_1_2', 'tit_11_1_3', 'tit_11_1_4',
            'tit_12', 'tit_13', 'tit_14', 'tit_14_1', 'tit_14_2', 'tit_14_2_1', 'tit_14_2_2', 'tit_14_3', 'tit_15','tit_16', 'tit_16_1', 'tit_16_2', 'tit_16_3', 'tit_16_3_1', 'tit_16_3_2', 'tit_16_3_3', 'tit_16_3_4',
            'patrocinante', 'video_referidos', 'terminos_referidos',
            'url_imagen_beneficios_dorados', 'footer_formulario_dorados', 'texto_bienvenida_dorados',
            'video_de_bienvenida_dorados', 'url_tyc_dorados','url_popup_dorado','act_pop_inicial','link_pop_inicial','target_popup','seccion_destino_popup', 
            'titulo_0_1','sub_titulo_1_1','sub_titulo_1_2','sub_titulo_1_3','sub_titulo_1_4','sub_titulo_1_5',
            'titulo_0_2','sub_titulo_2_1','sub_titulo_2_2','sub_titulo_2_3','sub_titulo_2_4','boton_1_activo','boton_1_texto','boton_2_activo','boton_2_texto'
        ]);
        $data["status"] = 'exito';
        $data["data"] = $configuracion;
        $data["data"]["patrocinante"] = config('app.url') . 'patrocinantes/' . $configuracion->patrocinante;
        $data["data"]["pop_inicial"] = config('app.url') . 'configuracion/'.Configuracion::first()->url_popup_inicial;
        $data["data"]["url_vistas"] = config('app.share_url');
        $data["data"]["total_hinchas"] = Usuario::count();
        return $data;
    }

    public function multimedia()
    {
        $data["status"] = 'exito';
        $data["data"] = Multimedia::first(['url_envivo']);
        return $data;
    }
}
