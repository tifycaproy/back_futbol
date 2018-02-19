<?php

namespace App\Http\Controllers;

use App\SeccionesDoradas;

class DoradosController extends Controller
{
    public function index()
    {
        $secciones = SeccionesDoradas::all();
        return view('dorados.index')->with('secciones', $secciones);;
    }

}
