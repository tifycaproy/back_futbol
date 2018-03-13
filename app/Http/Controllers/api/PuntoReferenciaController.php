<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PuntoReferencia;

class PuntoReferenciaController extends Controller
{

    public function punto_referencia()
    {
        return PuntoReferencia::with(['imagenes'])->orderBy('id', 'Desc');
    }

}
