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
            'url_tabla'=> $request->url_tabla,
            'url_simulador'=> $request->url_simulador,
            'url_juramento'=> $request->url_juramento,
            'url_livestream'=> $request->url_livestream,
        ]);
        return redirect()->route('configuracion');
    }
}
