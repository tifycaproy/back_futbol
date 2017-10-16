<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jugador;


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
}
