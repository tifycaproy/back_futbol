<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendario;
use App\Onceideal;
use App\Jugador;
use App\Compartir;
use App\Referido;
use App\Usuario;
use App\Configuracion;



class CompartirController extends Controller
{

    public function onceideal($ruta)
    {
       //dd($ruta); 
       list($idusuario,$idcalendario) = explode('.', $ruta);
        $idusuario=decodifica($idusuario);
        $idcalendario=decodifica($idcalendario);
        //dd($idusuario,$idcalendario);
        $fecha=Calendario::find($idcalendario);
        $once=Onceideal::where('usuario_id',$idusuario)->where('calendario_id',$idcalendario)->first();
        if(isset($fecha)){  
            $data=[
                "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                "equipo_1"=>$fecha->equipo1->nombre,
                "equipo_2"=>$fecha->equipo2->nombre,
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
        }else{ $seccion='calendario';
        $seccion=Compartir::where('seccion',$seccion)->first();
        return view('compartir.general')->with('seccion',$seccion);
      }    
    }

    public function onceidealr($ruta,$id)
    {
       //dd($ruta); 
       list($idusuario,$idcalendario) = explode('.', $ruta);
        $idusuario=decodifica($idusuario);
        $idcalendario=decodifica($idcalendario);
        //dd($idusuario,$idcalendario);
        $fecha=Calendario::find($idcalendario);
        $once=Onceideal::where('usuario_id',$idusuario)->where('calendario_id',$idcalendario)->first();
        if(isset($fecha)){  
            $data=[
                "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                "equipo_1"=>$fecha->equipo1->nombre,
                "equipo_2"=>$fecha->equipo2->nombre,
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
        }else{ $seccion='calendario';
        $seccion=Compartir::where('seccion',$seccion)->first();
        return view('compartir.general')->with('seccion',$seccion);
      }    
    }


    public function alineacion($id)
    {
        $seccion='alineacion';
        $seccion=Compartir::where('seccion',$seccion)->first();

         
        $data["status"]='exito';
        $configuración=Configuracion::first();
        $fecha=$configuración->partido_alineacion;
        $data = [
            "equipo_1"=>$fecha->equipo1->nombre,
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "equipo_2"=>$fecha->equipo2->nombre,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "copa"=>$fecha->copa->titulo,
            
        ];

        return view('compartir.alineacion')->with("seccion",$seccion)->with("data",$data);
        
    }

 public function show($seccion)
    {

        if($seccion=Compartir::where('seccion',$seccion)->first()){

            return view('compartir.general')->with('seccion',$seccion);
        }
     
    }
    public function general($seccion, $id)
    {
              
        if($seccion=Compartir::where('seccion',$seccion)->first()){

            return view('compartir.general')->with('seccion',$seccion);
        }


    }

    public function referidos($codigo)
    {
        try{
         $errors=[];
         $idusuario=decodifica($codigo);
         if($idusuario=="") $errors[]="El codigo es incorrecto";
         if(count($errors)>0){
             return ["status" => "fallo", "error" => $errors];
         }
         $codigo_referido = $idusuario;
         $nombre="";
         $zusuarios =  Usuario::where('id','=',$codigo_referido)->first();
         if(isset($zusuarios->nombre)){
           $nombre = $zusuarios->nombre." ".$zusuarios->apellido;   
         }
         return view('compartir.referidos.referidos')->with('codigo',$codigo_referido)->with('nombre',$nombre);
     } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
    }     
  } 

    public function email($codigo)
    {
       $codigo_referido = $codigo;
       $nombre="";
       $zusuarios =  Usuario::where('id','=',$codigo_referido)->first();
       if(isset($zusuarios->nombre)){
           $nombre = $zusuarios->nombre." ".$zusuarios->apellido;   
       }

       return view('compartir.referidos.email')->with('codigo',$codigo_referido)->with('nombre',$nombre);
    }
    public function descargar()
    {
      return view('compartir.referidos.descargar');
    }

}
