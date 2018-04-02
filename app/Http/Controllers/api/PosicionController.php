<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Copa;
use App\Posicion;



class PosicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public  function posicion()
    {
        $posiciones = Posicion::all();
        $copas=Copa::where('activa',1)->get();
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($copas as $copa){

            $posicion=[];
            foreach ($posiciones as $pos) {

                if($copa->id == $pos->copa_id){

                    $posicion[]=[
                        'pos' => $pos->pos,
                        'bandera' => config('app.url') . 'equipos/' . $pos->equipo->bandera,
                        'equipo_id' => $pos->equipo->nombre,
                        'pt' => $pos->pt,
                        'pj' => $pos->pj,
                        'pg' => $pos->pg,
                        'pp' => $pos->pp,
                        'pe' => $pos->pe,
                        'gc' => $pos->gc,
                        'gf' => $pos->gf,
                        'dif' => $pos->dif
                    ];

                }
            }

            if($posicion != []){
                $data["data"][]=[
                    'copa_id' => $pos->copa_id,
                    "copa" => $copa->titulo,
                    "posiciones" => $posicion

                ];

            }
        }

        return $data;
    }



}
