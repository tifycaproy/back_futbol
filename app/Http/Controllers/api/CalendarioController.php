<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copa;
use App\Convocado;
use App\Configuracion;


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
                ];
            }
            $data["data"][]=[
                "copa" => $copa->titulo,
                "partidos" => $fechas
            ];
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
            "equipo_1"=>$fecha->equipo1->nombre,
            "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
            "goles_1"=>$fecha->goles_1,
            "equipo_2"=>$fecha->equipo2->nombre,
            "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
            "goles_2"=>$fecha->goles_2,
            'fecha'=>date('Y-m-d',strtotime($fecha->fecha)) . ' ',
            'fecha_etapa'=>$fecha->fecha_etapa,
            'estadio'=>$fecha->estadio,
        ];
        $jugadores=[];
        $convocados=Convocado::orderby('orden','desc')->get();
        foreach ($convocados as $convocado) {
            $jugadores[]=[
                'idjudador' => $convocado->jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $convocado->jugador->banner,
            ];
        }
        $data["data"]['jugadores']=$jugadores;
        return $data;
    }
}
