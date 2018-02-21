<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    

	public function showPayu($tokenUsuario,$idMembresia)
    {

    	 return view('pagos.payu.formulario');

    }

}