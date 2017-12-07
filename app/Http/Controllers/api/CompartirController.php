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
        $ventanas=Compartir::get(['seccion']);

        $data["status"]='exito';
        $data["data"]=$ventanas;
 
        foreach($data["data"] as &$ventana){
            $ventana->url=config('app.share_url') . 'compartir/' . $ventana->seccion;
        }
        return $data;
    }
}
