<?php

namespace App\Http\Controllers;

use App\Suscripciones;
use App\RazonesCancelarSuscripciones;

class SuscripcionesControllers extends Controller
{
    public function index()
    {
        $suscripciones = Suscripciones::all();
        return ["status" => "exito", "data" => $suscripciones];
    }

    public function razonesCancelar()
    {
        $suscripciones = RazonesCancelarSuscripciones::all();
        return ["status" => "exito", "data" => $suscripciones];
    }
}
