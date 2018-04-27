<?php

namespace App\Http\Controllers\api;

use App\BeneficiosDorados;
use App\RazonesCancelarSuscripciones;
use App\Suscripciones;
use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UsuariosSuscripciones;

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

        $suscripciones=BeneficiosDorados::select('id','link','titulo','descripcion','fecha','tipo','url')
        ->where('active',1)
        ->orderby('id','desc')
        ->paginate(25);

        $data["status"]='exito';
        $data["data"]=[];
        foreach ($suscripciones as $suscripcion) {

            $data["data"][]=$suscripcion;
        }
        
        return $data;
    }

    public function cancelar(Request $request)
    { 
        $idusuario = decodifica_token($request->token);
        if ($idusuario == "") {
            return response()->json(['status' => 'error', 'error' => ["El token es incorrecto!"]]);
        }

        $usuario = Usuario::where('id', $idusuario)->first();

        $usuario->update(['dorado' => false]);

        $suscripcion = UsuariosSuscripciones::all()->where('id_usuario',$idusuario)->where('fecha_fin','>', \Carbon\Carbon::now())->where('status', 'APROBADO')->first();
        if($suscripcion)
        {
            $suscripcion->status = 'CANCELADO';
            $suscripcion->fecha_fin = \Carbon\Carbon::now();
            $suscripcion->save();
        }
        return response()->json(['status' => 'exito', 'data' => ["Ya no eres Dorado :'("]]);
    }

    public function statusSuscripcion($tokenUsuario){

        $idusuario = decodifica_token($tokenUsuario);
        
        if ($idusuario == "") {
            return response()->json(['status' => 'error', 'error' => ["El token es incorrecto!"]]);
        }

        $suscripcion = UsuariosSuscripciones::all()->where('id_usuario',$idusuario)->where('fecha_fin','>', \Carbon\Carbon::now())->where('status', 'APROBADO')->first();
        
        if($suscripcion)
        {    
            return response()->json(['status' => 'exito', 'data' => ["El usuario tiene suscripcion activa"]]);
        }
        else
        {
            $suscripcion = UsuariosSuscripciones::all()->where('id_usuario',$idusuario)->where('fecha_fin','>', \Carbon\Carbon::now())->where('status','PENDIENTE')->first();
            if($suscripcion)
            { 
                return response()->json(['status' => 'pendiente', 'data' => ["El usuario tiene suscripcion pendiente"]]);
            }
            else
            {
                $suscripcion = UsuariosSuscripciones::all()->where('id_usuario',$idusuario)->where('fecha_fin','>', \Carbon\Carbon::now())->where('status','RECHAZADO')->first();
                if($suscripcion)
                { 
                   return response()->json(['status' => 'fallo', 'data' => ["El usuario tiene suscripcion rechazada"]]);
               }
               else
                return response()->json(['status' => 'no_existe', 'data' => ["El usuario nunca ha solicitado suscripcion"]]);
        }
    }

}


public function reset(Request $request)
{
    $request = json_decode($request->getContent());
    $request = get_object_vars($request);
 $idusuario = decodifica_token($request["token"]);
 $suscripcion = UsuariosSuscripciones::all()->where('id_usuario',$idusuario)->where('status', 'PENDIENTE')->first();
 if(!$suscripcion)
 {
    return ["status" => "fallo", "data" => "No tienes transacciones pendientes"];
}
$suscripcion->delete();

return ["status" => "exito", "data" => "Transacción pendiente eliminada"];
}


}
