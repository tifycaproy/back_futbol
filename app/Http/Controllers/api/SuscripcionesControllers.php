<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Suscripciones;

class SuscripcionesControllers extends Controller
{
    public function index()
    {
        $suscripciones = Suscripciones::all();
        return ["status" => "exito", "data" => $suscripciones];
    }
}
