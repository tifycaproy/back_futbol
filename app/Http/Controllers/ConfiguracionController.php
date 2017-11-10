<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;

use App\Configuracion;
use App\Calendario;

class ConfiguracionController extends Controller
{

    public function index()
    {
        $configuracion=Configuracion::first();
        $partidos=Calendario::where("equipo_1",1)->orwhere('equipo_2',1)->orderby('fecha','desc')->get();
        return view('configuracion.configuracion')->with('configuracion',$configuracion)->with('partidos',$partidos);
    }
    public function configuracion_actualizar(Request $request)
    {
        Configuracion::find(1)->update([
            'calendario_convodados_id'=> $request->calendario_convodados_id,
            'calendario_aplausos_id'=> $request->calendario_aplausos_id,
            'calendario_alineacion_id'=> $request->calendario_alineacion_id,
            'url_tabla'=> $request->url_tabla,
            'url_simulador'=> $request->url_simulador,
            'url_juramento'=> $request->url_juramento,
            'url_livestream'=> $request->url_livestream,
            'url_tienda'=> $request->url_tienda,
            'url_estadisticas'=> $request->url_estadisticas,
            'url_academia'=> $request->url_academia,
            'tit_1'=> $request->tit_1,
            'tit_2'=> $request->tit_2,
            'tit_3'=> $request->tit_3,
            'tit_4'=> $request->tit_4,
            'tit_4_1'=> $request->tit_4_1,
            'tit_4_2'=> $request->tit_4_2,
            'tit_5'=> $request->tit_5,
            'tit_6'=> $request->tit_6,
            'tit_6_1'=> $request->tit_6_1,
            'tit_6_1_1'=> $request->tit_6_1_1,
            'tit_6_1_2'=> $request->tit_6_1_2,
            'tit_6_2'=> $request->tit_6_2,
            'tit_6_3'=> $request->tit_6_3,
            'tit_6_3_1'=> $request->tit_6_3_1,
            'tit_6_3_2'=> $request->tit_6_3_2,
            'tit_7'=> $request->tit_7,
            'tit_7_1'=> $request->tit_7_1,
            'tit_7_2'=> $request->tit_7_2,
            'tit_8'=> $request->tit_8,
            'tit_9'=> $request->tit_9,
            'tit_10'=> $request->tit_10,
            'tit_10_1'=> $request->tit_10_1,
            'tit_10_2'=> $request->tit_10_2,
            'tit_11'=> $request->tit_11,
            'tit_11_1'=> $request->tit_11_1,
            'tit_11_1_1'=> $request->tit_11_1_1,
            'tit_11_1_2'=> $request->tit_11_1_2,
            'tit_11_1_3'=> $request->tit_11_1_3,
            'tit_11_1_4'=> $request->tit_11_1_4,
            'tit_12'=> $request->tit_12,
            'tit_13'=> $request->tit_13,
            'tit_14'=> $request->tit_14,
            'tit_14_1'=> $request->tit_14_1,
            'tit_14_2'=> $request->tit_14_2,
            'tit_14_3'=> $request->tit_14_3,
            'tit_15'=> $request->tit_15,
        ]);
        return redirect()->route('configuracion')->with("notificacion","Se ha guardado correctamente su información");
    }
}
