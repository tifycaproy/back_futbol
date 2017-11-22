<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Onceideal;

class CompartirController extends Controller
{

    public function onceideal($slug)
    {
        if($ususario=Usuario::where('apodo',$slug)->first()){
            $idusuario=$ususario->id;
        }else if($ususario=Usuario::find($slug)){
            $idusuario=$ususario->id;
        }
        $once=Onceideal::where('usuario_id',$idusuario)->orderby('id','desc')->first(['foto']);
        return view('compartir.onceideal')->with('ususario',$ususario)->with('once',$once);
    }
}
