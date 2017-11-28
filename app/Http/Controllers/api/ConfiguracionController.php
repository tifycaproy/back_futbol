<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuracion;


class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracion=Configuracion::first([
            'url_tabla','url_simulador','url_juramento','url_livestream','url_tienda','url_estadisticas','url_academia',
            'tit_1','tit_1_1','tit_1_2','tit_2','tit_3','tit_4','tit_4_1','tit_4_2','tit_5','tit_6','tit_6_1','tit_6_1_1','tit_6_1_2','tit_6_2','tit_6_3','tit_6_3_1','tit_6_3_2','tit_7',
            'tit_7_1','tit_7_2','tit_8','tit_9','tit_10','tit_10_1','tit_10_2','tit_11','tit_11_1','tit_11_1_1','tit_11_1_2','tit_11_1_3','tit_11_1_4',
            'tit_12','tit_13','tit_14','tit_14_1','tit_14_2','tit_14_2_1','tit_14_2_2','tit_14_3','tit_15','patrocinante',
        ]);

        $data["status"]='exito';
        $data["data"]=$configuracion;
        $data["data"]["patrocinante"]=config('app.url') . 'patrocinantes/' . $configuracion->patrocinante;
        return $data;
    }
}
