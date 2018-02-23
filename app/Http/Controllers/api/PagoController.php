<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    

	public function showPayu($tokenUsuario,$idMembresia)
    {
        //TODO - Traer datos de usuario
        //TODO - Traer info de costos por membresia
    	$datos = new \stdClass();
    	$datos->ApiKey = '4Vj8eK4rloUd272L48hsrarnUA';
    	$datos->merchantId = '508029';
    	$datos->reference = 'TestPayUMillonarios'. rand(0, 10000);
    	$datos->Amount = '20000';
    	$datos->currency = 'COP';
    	$datos->signature = md5($datos->ApiKey .'~'. $datos->merchantId.'~'. $datos->reference . '~' . $datos->Amount . '~' . $datos->currency);

    	 return view('pagos.payu.formulario')->with('datos',$datos);

    }

    public function responsePayu(Request $request)
    {
    	 return view('pagos.payu.response')->with('request',$request);
    }

}