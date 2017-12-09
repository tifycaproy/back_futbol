<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendario;
use App\Onceideal;
use App\Jugador;
use App\Compartir;

class CompartirController extends Controller
{

    public function onceideal($ruta)
    {
        list($idusuario,$idcalendario) = explode('.', $ruta);
        $idusuario=decodifica($idusuario);
        $idcalendario=decodifica($idcalendario);

        $fecha=Calendario::find($idcalendario);
        $once=Onceideal::where('usuario_id',$idusuario)->where('calendario_id',$idcalendario)->first();
        $data=[
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "copa"=>$fecha->copa->titulo,
            "foto" => config('app.url') . 'onceideal/' . $once->foto,
        ];

        for($l=1; $l<=11; $l++){
            if($jugador=Jugador::find($once["idjugador" . $l])){
                $data['jugadores'][]=[
                    'nombre' => $jugador->nombre,
                    'foto'=>config('app.url') . 'jugadores/' . $jugador->foto,
                ];
            }
        }
        return view('compartir.onceideal')->with("data",$data);
    }

    public function general($seccion, $id='')
    {
        if($seccion=Compartir::where('seccion',$seccion)->first()){
            return view('compartir.general')->with('seccion',$seccion);
        }
    }
}
