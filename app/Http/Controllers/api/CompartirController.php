<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Compartir;


class CompartirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventanas=Compartir::get(['seccion','titulo','descripcion','foto']);

        $data["status"]='exito';
        $data["data"]=$ventanas;
 
        foreach($data["data"] as &$ventana){
            if($ventana["foto"]<>''){
                $ventana['foto']=config('app.url') . 'ventanas/' . $ventana['foto'];
            }
        }
        return $data;
    }
}
