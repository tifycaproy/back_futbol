<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jugador;
use App\Aplauso;
use App\AplausoCalendario;



class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nomina()
    {
        $judadores=Jugador::where('activo',1)->select('id','banner')->orderby('n_camiseta')->get();
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjudador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        return $data;
    }
    public function single_jugador($id)
    {
        if($jugador=Jugador::find($id)){
            $data["status"]='exito';
            $data["data"]=[
                'idjudador' => $jugador->id,
                'nombre' => $jugador->nombre,
                'fecha_nacimiento' => $jugador->fecha_nacimiento,
                'nacionalidad' => $jugador->nacionalidad,
                'n_camiseta' => $jugador->n_camiseta,
                'posicion' => $jugador->posicion,
                'banner'=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
            if($sepuedeaplaudir=AplausoCalendario::where('activo',1)->orderby('id','desc')->first()){
                $fecha=$sepuedeaplaudir->fecha;
                $partido=[
                    'sepuedeaplaudir' => 1,
                    'idpartido'=>$fecha->id,
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
                $data["data"] = array_merge($data["data"], $partido);
            }else{
                $data["data"]['sepuedeaplaudir'] = 0;
            }
            if($ultimopartido=AplausoCalendario::orderby('id','desc')->first()){
                $data["data"]['apalusos_ultimo_partido'] = 0;
            }else{
                $data["data"]['apalusos_ultimo_partido'] = 0;
            }
            $data["data"]['aplausos_acumulado']=Aplauso::where('jugadores_id',$id)->count();
            
        }else{
            $data["status"]='fallo';
            $data["error"]=['idjugador incorrecto'];
        }
        return $data;
    }
}
