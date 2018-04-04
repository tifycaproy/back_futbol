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
        $data["status"]='exito';
        $data["data"]=[];
        $posicion=[];
        foreach ($posiciones as $pos) {

                $posicion[]=[
                    'idposicion' => $pos->id,
                    'posicion' => $pos->pos,
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
        if($posicion != []){
            $data["data"]= $posicion;
        }

        return $data;
    }



}
