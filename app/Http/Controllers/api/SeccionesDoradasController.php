<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\SeccionesDoradas;
use Illuminate\Http\Request;

class SeccionesDoradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfig()
    {
        return response()->json(SeccionesDoradas::where('id','<','13')->get());
    }

    public function getConfigV2()
    {
        return response()->json(SeccionesDoradas::all());
    }


    public function editarSeccion(Request $request,$idseccion)
    {
        if($request->has('solo_dorado'))
        {
     		$seccion = SeccionesDoradas::find($idseccion);
     		$seccion->solo_dorado = true;
     		$seccion->save();
     		return redirect()->to('/secciones_doradas'); 
        }
        else{
        	$seccion = SeccionesDoradas::find($idseccion);
     		$seccion->solo_dorado = false;
     		$seccion->save(); 	
 	        return redirect()->to('/secciones_doradas');
        }

    }
}

