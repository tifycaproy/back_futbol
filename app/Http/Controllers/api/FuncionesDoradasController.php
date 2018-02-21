<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\FuncionesDoradas;
use Illuminate\Http\Request;

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
        	$funcion = FuncionesDoradas::find($idfuncion);
     		$funcion->solo_dorado = false;
     		$funcion->save(); 	
 	        return redirect()->to('/funciones_doradas');
        }

    }
}
