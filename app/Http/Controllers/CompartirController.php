<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendario;
use App\Onceideal;

class CompartirController extends Controller
{

    public function onceideal($ruta)
    {
        list($idusuario,$idcalendario) = explode('$', $ruta);
        $idusuario=decodifica($idusuario);
        $idcalendario=decodifica($idcalendario);

        $fecha=Calendario::find($idcalendario);
        $partido=[
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "copa"=>$fecha->copa->titulo,
        ];

        $once=Onceideal::where('usuario_id',$idusuario)->where('calendario_id',$idcalendario)->first(['foto']);
        return view('compartir.onceideal')->with('once',$once)->with("partido",$partido);
    }
}
