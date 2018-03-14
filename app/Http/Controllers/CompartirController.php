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
use App\Noticia;
use App\Videovr;
use App\Aplauso;

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

    public function usuario($id)
    {
        $footer1= "DESCARGA AHORA MISMO LA APP OFICIAL MILLONARIOS FC";
        $footer2 = "NO DEJEMOS DE SEGUIR NUNCA AL MÁS GRANDE";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/compartaelapp.jpeg";
        $descripcion = "¡CONVIÉRTETE EN HINCHA OFICIAL Y COMPARTE TU PASIÓN POR EL EMBAJADOR!";
        $titulo = "Comparte tu pasión";
        return view('compartir.user')->with('titulo',$titulo)->with('descripcion',$descripcion)->with('footer1',$footer1)->with('footer2',$footer2)->with('imagen',$imagen);

    }
    public function alineacion($id)
    {
        $seccion='alineacion';
        $seccion=Compartir::where('seccion',$seccion)->first();


        $data["status"]='exito';
        $configuracion=Configuracion::first();
        $fecha=$configuracion->partido_alineacion;
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
            return view('compartir.referidos.referidos')->with('codigo',$codigo)->with('codigo_id',$idusuario)->with('nombre',$nombre);
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }

    public function email($codigo)
    {
        $codigo_referido = $codigo;
        $idusuario = decodifica($codigo);
        $nombre="";
        $zusuarios =  Usuario::where('id','=',$idusuario)->first();
        if(isset($zusuarios->nombre)){
            $nombre = $zusuarios->nombre." ".$zusuarios->apellido;
        }

        return view('compartir.referidos.email')->with('codigo',$codigo_referido)->with('nombre',$nombre)->with('codigo_id',$idusuario);
    }

    public function noticia($id)
    {
        $seccion='noticias';
        $seccion=Compartir::where('seccion',$seccion)->first();
        $noticia=Noticia::find($id);
        return view('compartir.noticia',['noticia'=>$noticia, 'seccion'=>$seccion]);
    }
    public function partido($id)
    {
        $seccion='calendario';
        $seccion=Compartir::where('seccion',$seccion)->first();

        $data["status"]='exito';
        $fecha=Calendario::find($id);
        $data = [
            "equipo_1"=>$fecha->equipo1->nombre,
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "equipo_2"=>$fecha->equipo2->nombre,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "copa"=>$fecha->copa->titulo,

        ];

        return view('compartir.partido')->with("seccion",$seccion)->with("data",$data);
    }
    public function videovr($id)
    {
        $seccion='noticias';
        $seccion=Compartir::where('seccion',$seccion)->first();
        $videovr=Videovr::find($id);
        return view('compartir.videovr',['videovr'=>$videovr, 'seccion'=>$seccion]);
    }
    public function jugador($id)
    {
        $seccion='jugador_aplausos';
        $seccion=Compartir::where('seccion',$seccion)->first();
        $jugador=Jugador::find($id);
        $partidoaaplaudor=Configuracion::first(['calendario_aplausos_id']);
        $idcalendario=$partidoaaplaudor->calendario_aplausos_id;
        if($idcalendario==0){
            if($partidoaaplaudor=Aplauso::orderby('created_at','desc')->first(['calendario_id'])){
                $idcalendario=$partidoaaplaudor->calendario_id;
            }
        }
        $jugador->apalusos_ultimo_partido = Aplauso::where('calendario_id',$idcalendario)->where('jugadores_id',$id)->count();
        $jugador->aplausos_acumulado=Aplauso::where('jugadores_id',$id)->count();
        return view('compartir.jugador',['jugador'=>$jugador, 'seccion'=>$seccion]);
    }
    public function jugador_single($id)
    {
        $seccion='jugador';
        $seccion=Compartir::where('seccion',$seccion)->first();
        $jugador=Jugador::find($id);
        return view('compartir.jugador_single',['jugador'=>$jugador, 'seccion'=>$seccion]);
    }
    public function tueliges($id)
    {
        $seccion='tueliges';
        $seccion=Compartir::where('seccion',$seccion)->first();
        $jugador=Jugador::find($id);
        return view('compartir.jugador_single',['jugador'=>$jugador, 'seccion'=>$seccion]);
    }
}
//