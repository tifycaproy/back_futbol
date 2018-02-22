<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    

	public function showPayu($tokenUsuario,$idMembresia)
    {
    	$ApiKey = '4Vj8eK4rloUd272L48hsrarnUA';
    	$merchantId = '508029';
    	$reference = 'TestPayUMillonarios';
    	$Amount = '20000';
    	$currency = 'COP';

    	 return view('pagos.payu.formulario')->with('datos',$datos);

    }

    public function responsePayu(Request $request)
    {

    	 dd($request);

    }

}