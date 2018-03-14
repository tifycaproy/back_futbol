<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PuntoReferencia;

class PuntoReferenciaController extends Controller
{

    public function punto_referencia()
    {
    	$data["status"]='exito';
    	$data["data"]=[];
    	foreach (PuntoReferencia::all() as $punto ) {
    		$data["data"][]=[
                'titulo'=>$punto->nombre,
                'latitud'=>$punto->cordx,
                'longitud'=>$punto->cordy,
                'fecha'=>$punto->created_at->toDateTimeString(),
                'imagenes' => $punto->imagenes
            ];

    	}
        return $data;
    }

}
