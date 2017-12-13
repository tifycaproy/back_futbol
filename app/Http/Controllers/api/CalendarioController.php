<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copa;
use App\Convocado;
use App\Configuracion;
use App\Calendario;
use App\Jugador;
use App\Playbyplay;


class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copas()
    {
        $copas=Copa::where('activa',1)->select('id as idcopa', 'titulo')->get();
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($copas as $copa) {
            $data["data"][]=$copa;
        }
        return $data;
    }
    public function partidos()
    {
        $copas=Copa::where('activa',1)->get();
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($copas as $copa) {
            $fechas=[];
            foreach ($copa->fechas_partidos as $fecha){
                $fechas[]=[
                    'idpartido'=>$fecha->id,
                    "estado"=>$fecha->estado,
                    "equipo_1"=>$fecha->equipo1->nombre,
                    "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                    "goles_1"=>$fecha->goles_1,
                    "equipo_2"=>$fecha->equipo2->nombre,
                    "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
                    "goles_2"=>$fecha->goles_2,
                    'fecha'=>$fecha->fecha,
                    'fecha_etapa'=>$fecha->fecha_etapa,
                    'estadio'=>$fecha->estadio,
                    'info'=>$fecha->info,
                ];
            }
            $data["data"][]=[
                "copa" => $copa->titulo,
                "partidos" => $fechas
            ];
        }
        return $data;
    }
    public function calendario()
    {
        $copas=Copa::where('activa',1)->get();
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($copas as $copa) {
            $fechas=[];
            foreach ($copa->fechas_calendario as $fecha){
                $fechas[]=[
                    'idpartido'=>$fecha->id,
                    "estado"=>$fecha->estado,
                    "equipo_1"=>$fecha->equipo1->nombre,
                    "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                    "goles_1"=>$fecha->goles_1,
                    "equipo_2"=>$fecha->equipo2->nombre,
                    "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
                    "goles_2"=>$fecha->goles_2,
                    'fecha'=>$fecha->fecha,
                    'fecha_etapa'=>$fecha->fecha_etapa,
                    'estadio'=>$fecha->estadio,
                    'info'=>$fecha->info,
                ];
            }
            $data["data"][]=[
                "copa" => $copa->titulo,
                "partidos" => $fechas
            ];
        }
        return $data;
    }
    public function single_calendario($id)
    {
        if($fecha=Calendario::find($id)){
            $data["status"]='exito';
            $data["data"]=[
                    'idpartido'=>$fecha->id,
                    "estado"=>$fecha->estado,
                    "equipo_1"=>$fecha->equipo1->nombre,
                    "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                    "goles_1"=>$fecha->goles_1,
                    "equipo_2"=>$fecha->equipo2->nombre,
                    "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
                    "goles_2"=>$fecha->goles_2,
                    'fecha'=>$fecha->fecha,
                    'fecha_etapa'=>$fecha->fecha_etapa,
                    'estadio'=>$fecha->estadio,
                    'estadio'=>$fecha->estadio,
                    'info'=>$fecha->info,
            ];
            $noticias=$fecha->noticias;
            $data["data"]['noticias']=[];
            foreach ($noticias as $noticia) {
                if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
                unset($noticia->pivot);
                $data["data"]['noticias'][]=$noticia;
            }

        }else{
            $data["status"]='fallo';
            $data["error"]=['idpartido incorrecto'];
        }
        return $data;
    }
    public function convocados()
    {
        $data["status"]='exito';
        $configuración=Configuracion::first();
        $fecha=$configuración->partido;
        $data["data"]=[
            'idpartido'=>$fecha->id,
            'estado' =>$fecha->estado,
            "equipo_1"=>$fecha->equipo1->nombre,
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "goles_1"=>$fecha->goles_1,
            "equipo_2"=>$fecha->equipo2->nombre,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "goles_2"=>$fecha->goles_2,
            'fecha'=>date('Y-m-d H:i',strtotime($fecha->fecha)),
            'fecha_etapa'=>$fecha->fecha_etapa,
            'estadio'=>$fecha->estadio,
            'info'=>$fecha->info,
        ];
        $jugadores=[];
        $convocados=Convocado::orderby('orden','desc')->get();
        foreach ($convocados as $convocado) {
            $jugadores[]=[
                'idjugador' => $convocado->jugador->id,
                'nombre' => $convocado->jugador->nombre,
                "foto"=>config('app.url') . 'jugadores/' . $convocado->jugador->foto,
                "banner"=>config('app.url') . 'jugadores/' . $convocado->jugador->banner,
            ];
        }
        $data["data"]['jugadores']=$jugadores;
        return $data;
    }

    public function playbyplay()
    {
        $data["status"]='exito';
        $configuración=Configuracion::first();
        $fecha=$configuración->partido_alineacion;
        $data["data"]=[
            'idpartido'=>$fecha->id,
            'estado' =>$fecha->estado,
            "equipo_1"=>$fecha->equipo1->nombre,
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "goles_1"=>$fecha->goles_1,
            "equipo_2"=>$fecha->equipo2->nombre,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "goles_2"=>$fecha->goles_2,
            'fecha'=>date('Y-m-d H:i',strtotime($fecha->fecha)),
            'fecha_etapa'=>$fecha->fecha_etapa,
            'estadio'=>$fecha->estadio,
            'video'=>$fecha->video,
            'info'=>$fecha->info,
            'formacion'=>$fecha->formacion->titulo,
            "foto_formacion"=>config('app.url') . 'formaciones/' . $fecha->formacion->foto,
        ];
        if($dt=Jugador::where("posicion",'Director técnico')->first()){
            $data["data"]["idjugador"]=$dt->id;
            $data["data"]["nombre_dt"]=$dt->nombre;
            $data["data"]["foto_dt"]=config('app.url') . 'jugadores/' . $dt->foto;
        }

        $titulares=[];
        $jugadores=$fecha->titulares;
        foreach ($jugadores as $jugador) {
            $actividad_bd=Playbyplay::where("jugador_id",$jugador->jugador->id)->where("calendario_id",$fecha->id)->get();
            $actividades=[];
            foreach ($actividad_bd as $actividad) {
                $actividades[]=[
                    'actividad'=>$actividad->actividad,
                    'minuto'=>$actividad->minuto,                    
                ];
            }
            $titulares[]=[
                'idjugador' => $jugador->jugador->id,
                "foto"=>config('app.url') . 'jugadores/' . $jugador->jugador->foto,
                'nombre' => $jugador->jugador->nombre,
                'posicion' => $jugador->posicion,
                'actividades'=>$actividades,
            ];
        }
        $data["data"]['titulares']=$titulares;

        $suplentes=[];
        $jugadores=$fecha->suplentes;
        foreach ($jugadores as $jugador) {
            $actividad_bd=Playbyplay::where("jugador_id",$jugador->jugador->id)->where("calendario_id",$fecha->id)->get();
            $actividades=[];
            foreach ($actividad_bd as $actividad) {
                $actividades[]=[
                    'actividad'=>$actividad->actividad,
                    'minuto'=>$actividad->minuto,                    
                ];
            }
            $suplentes[]=[
                'idjugador' => $jugador->jugador->id,
                "foto"=>config('app.url') . 'jugadores/' . $jugador->jugador->foto,
                'nombre' => $jugador->jugador->nombre,
                'actividades'=>$actividades,
            ];
        }
        $data["data"]['suplentes']=$suplentes;
        return $data;
    }
}
