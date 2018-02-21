<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copafb;
use App\Calendariofb;


class CalendariofbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendariofb()
    {
        $copas=Copafb::where('activa',1)->get();
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
    public function single_calendariofb($id)
    {
        if($fecha=Calendariofb::find($id)){
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

}
