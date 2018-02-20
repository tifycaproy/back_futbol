<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\FuncionesDoradas;

class FuncionesDoradasController extends Controller
{
 public function editarFuncion(Request $request,$idfuncion)
    {
        if($request->has('solo_dorado'))
        {
     		$funcion = FuncionesDoradas::find($idfuncion);
     		$funcion->solo_dorado = true;
     		$funcion->save();
     		return redirect()->to('/funciones_doradas'); 
        }
        else{
        	$funcion = SeccionesDoradas::find($idfuncion);
     		$funcion->solo_dorado = false;
     		$funcion->save(); 	
 	        return redirect()->to('/funciones_doradas');
        }

    }
}
