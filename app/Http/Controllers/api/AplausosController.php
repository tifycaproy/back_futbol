<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jugador;
use App\Aplauso;
use App\Configuracion;

class AplausosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aplausos_equipo()
    {
        //último partido
        $idcalendario=0;
        $partidoaaplaudor=Configuracion::first(['calendario_aplausos_id']);
        if($partidoaaplaudor->calendario_aplausos_id<>0){
            $idcalendario=$partidoaaplaudor->calendario_aplausos_id;
        }else{
            if($partidoaaplaudor=Aplauso::orderby('created_at','desc')->first(['calendario_id'])){
                $idcalendario=$partidoaaplaudor->calendario_id;
            }
        }

        $jugadores=Jugador::get()->sortby(function($jugador) use ($idcalendario){
            return $jugador->aplausos_up($idcalendario)->count();
        })->where('calendario_id',$idcalendario);

        $data["status"]='exito';
        $data["data"]['partido_actual']=[];
        $total=0;
        foreach($jugadores->reverse() as $jugador){
            $votos=$jugador->aplausos_up($idcalendario)->count();
            if($votos>0){
                $data["data"]['partido_actual'][]=[
                    'idjugador' => $jugador->id,
                    'nombre' => $jugador->nombre,
                    'foto' => config('app.url') . 'jugadores/' . $jugador->foto,
                    'votos' => $votos,
                    'porcentaje' => 0,
                ];
                $total+=$votos;
            }
        }
        foreach ($data["data"]['partido_actual'] as &$voto) {
            $voto['porcentaje']=round(100 * $voto['votos'] / $total,2);
        }

        //total
        $jugadores=Jugador::get()->sortby(function($jugador){
            return $jugador->aplausos->count();
        });
        $data["status"]='exito';
        $data["data"]['acumulado']=[];
        $total=0;
        foreach($jugadores->reverse() as $jugador){
            if($jugador->aplausos->count()>0){
                $data["data"]['acumulado'][]=[
                    'idjugador' => $jugador->id,
                    'nombre' => $jugador->nombre,
                    'foto' => config('app.url') . 'jugadores/' . $jugador->foto,
                    'votos' => $jugador->aplausos->count(),
                    'porcentaje' => 0,
                ];
                $total+=$jugador->aplausos->count();
            }
        }
        foreach ($data["data"]['acumulado'] as &$voto) {
            $voto['porcentaje']=round(100 * $voto['votos'] / $total,2);
        }

        return $data;

    }
}
