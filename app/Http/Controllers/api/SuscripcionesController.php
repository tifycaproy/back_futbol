<?php

namespace App\Http\Controllers\api;

use App\BeneficiosDorados;
use App\RazonesCancelarSuscripciones;
use App\Suscripciones;
use App\Usuario;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class SuscripcionesController extends Controller
{
    public function index()
    {
        $suscripciones = Suscripciones::all();
        return ["status" => "exito", "data" => $suscripciones];
    }

    public function razonesCancelar()
    {
        $suscripciones = RazonesCancelarSuscripciones::all();
        return ["status" => "exito", "data" => $suscripciones];
    }

    public function beneficiosDorados()
    {
        $suscripciones = BeneficiosDorados::all();
        return ["status" => "exito", "data" => $suscripciones];
    }

    public function cancelar(Request $request)
    {
        $request = json_decode($request->getContent());
        $request = get_object_vars($request);

        $idusuario = decodifica_token($request["token"]);
        if ($idusuario == "") {
            return response()->json(['status' => 'error', 'error' => ["El token es incorrecto!"]]);
        }

        $usuario = Usuario::where('id', $idusuario)->first();

        $usuario->update(['dorado' => '0']);
        return response()->json(['status' => 'exito', 'data' => ["Ya no eres Dorado :'("]]);
    }
}
