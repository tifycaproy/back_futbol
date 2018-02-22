<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    

	public function showPayu($tokenUsuario,$idMembresia)
    {

    	 return view('pagos.payu.formulario');

    }

    public function responsePayu(Request $request)
    {

    	 dd($request);

    }

}