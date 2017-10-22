<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuracion;


class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracion=Configuracion::first(['url_tabla','url_simulador','url_juramento','url_livestream']);
        $data["status"]='exito';
        $data["data"]=$configuracion;
        return $data;
    }
}
