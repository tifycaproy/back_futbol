<?php

namespace App\Http\Controllers;

use App\SeccionesDoradas;
use App\FuncionesDoradas;

class DoradosController extends Controller
{
    public function indexSecciones()
    {
        $secciones = SeccionesDoradas::all();
        return view('dorados.secciones.index')->with('secciones', $secciones);
    }

    public function indexFunciones()
    {
        $funciones = FuncionesDoradas::all();
        return view('dorados.funciones.index')->with('funciones', $funciones);
    }

}
