<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\SeccionesDoradas;

class SeccionesDoradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfig()
    {
        return response()->json(SeccionesDoradas::all());
    }

    public function editarSeccion(Request $request)
    {
        dd($request);
    }
}

