<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Onceideal;

class CompartirController extends Controller
{

    public function onceideal($ruta)
    {
        list($idusuario,$idcalendario) = explode('$', $ruta);
        $idusuario=decodifica($idusuario);
        $idcalendario=decodifica($idcalendario);

        $once=Onceideal::where('usuario_id',$idusuario)->where('calendario_id',$idcalendario)->first(['foto']);
        return view('compartir.onceideal')->with('once',$once);
    }
}
