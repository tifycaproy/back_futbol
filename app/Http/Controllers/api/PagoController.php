<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Suscripciones;
use App\Usuario;
use App\UsuariosSuscripciones;
use Carbon\Carbon;

class PagoController extends Controller
{
    

	public function showPayu($tokenUsuario,$idSuscripcion)
    {
        //Traer datos de usuario
        $idusuario = decodifica_token($tokenUsuario);
        $usuario = Usuario::find($idusuario);
        //Verificar si usario existe
        if(!$usuario){ return ['status' => 'fallo','error'=>["Usuario No registrado"]];}
        //Traer info de costos por membresia TODO -- calcular si el usuario es mayor o menor de edad y traer respectivamente 
        $suscripcion = Suscripciones::find($idSuscripcion);
        //Buscamos el costo y guardamos
        $edad = !$usuario->fecha_nacimiento ? null : Carbon::parse($usuario->fecha_nacimiento)->age;
        ;
        $costo = $suscripcion->costo_menor;
        if( $edad >= 18){$costo = $suscripcion->costo_mayor;}
        if(is_null($edad)){$costo = $suscripcion->costo_mayor;}
        //Creamos suscripcion pendiente
        $usuariosSuscripcion = new UsuariosSuscripciones;
            $usuariosSuscripcion->id_usuario = $idusuario;
            $usuariosSuscripcion->id_tipo_membresia = $idSuscripcion;
            $usuariosSuscripcion->fecha_inicio = \Carbon\Carbon::now();
            $usuariosSuscripcion->fecha_fin = \Carbon\Carbon::now()->addDays($suscripcion->duracion);
            $usuariosSuscripcion->metodo_pago = 'payU';
            $usuariosSuscripcion->status = 'PENDIENTE';
            $usuariosSuscripcion->save();
        //Cargamos datos a enviar
    	$datos = new \stdClass();
    	$datos->ApiKey = '1Hzv6cMkOrR4XSWD4M1Ibu444o';
    	$datos->merchantId = '687059';
        $datos->buyerEmail = $usuario->email;
    	$datos->reference = 'PayUMillonarios'. rand(0, 10000);
    	$datos->Amount = number_format($costo, 0, '.', '');
    	$datos->currency = 'COP';
        $datos->descripcionSuscripcion = $suscripcion->descripcion;
    	$datos->signature = md5($datos->ApiKey .'~'. $datos->merchantId.'~'. $datos->reference . '~' . $datos->Amount . '~' . $datos->currency);
        $datos->extra3 = $idSuscripcion;
    	 return view('pagos.payu.formulario')->with('datos',$datos);

    }

    public function responsePayu(Request $request)
    {
        if($request['transactionState'] == 7)
        {
             $usuario = Usuario::where('email',$request->buyerEmail)->first();
            //Traemos el ID
            $idusuario = $usuario->id;
            //Buscamos la suscripción
            $suscripcion = Suscripciones::find($request->extra3);
            //Calcular la duracion
            $fecha_inicio_suscripcion = \Carbon\Carbon::now();

            //Guardamos info en usuarios suscripcion
            $usuariosSuscripcion = new UsuariosSuscripciones;
            $usuariosSuscripcion->id_usuario = $idusuario;
            $usuariosSuscripcion->id_tipo_membresia = $request->extra3;
            $usuariosSuscripcion->fecha_inicio = $fecha_inicio_suscripcion;
            $usuariosSuscripcion->fecha_fin = \Carbon\Carbon::now()->addDays($suscripcion->duracion);
            $usuariosSuscripcion->metodo_pago = 'payU';
            $usuariosSuscripcion->status = 'PENDIENTE';
            $usuariosSuscripcion->save();
        }

    	 return view('pagos.payu.response')->with('request',$request);
    }

    public function confirmationPayu(Request $request)
    {
        //Revisar estado de transaccion -> 4 = exitoso
        if($request->state_pol == 4){
            //Buscamos al usuario
            $usuario = Usuario::where('email',$request->email_buyer)->first();
            //Traemos el ID
            $idusuario = $usuario->id;
            //Buscamos la suscripción
            $suscripcion = Suscripciones::find($request->extra3);
            //Calcular la duracion
            $fecha_inicio_suscripcion = \Carbon\Carbon::now();
            //Borramos los status anteriores
            $suscripcionesActuales = UsuariosSuscripciones::where('id_usuario',$idusuario)->get();
            if($suscripcionesActuales)
            {
                UsuariosSuscripciones::where('id_usuario',$idusuario)->delete();
            }
            //Guardamos info en usuarios suscripcion
            $usuariosSuscripcion = new UsuariosSuscripciones;
            $usuariosSuscripcion->id_usuario = $idusuario;
            $usuariosSuscripcion->id_tipo_membresia = $request->extra3;
            $usuariosSuscripcion->fecha_inicio = $fecha_inicio_suscripcion;
            $usuariosSuscripcion->fecha_fin = \Carbon\Carbon::now()->addDays($suscripcion->duracion);
            $usuariosSuscripcion->metodo_pago = 'payU';
            $usuariosSuscripcion->status = 'APROBADO';
            $usuariosSuscripcion->save();
            //Guardamos info de usuario
            $usuario->dorado = true;
            $usuario->save();
        }elseif($request->state_pol == 6){
            //Buscamos al usuario
            $usuario = Usuario::where('email',$request->email_buyer)->first();
            //Traemos el ID
            $idusuario = $usuario->id;
            //Buscamos la suscripción
            $suscripcion = Suscripciones::find($request->extra3);
            //Calcular la duracion
            $fecha_inicio_suscripcion = \Carbon\Carbon::now();
            //Borramos suscripciones actuales
            $suscripcionesActuales = UsuariosSuscripciones::where('id_usuario',$idusuario)->get();
            if($suscripcionesActuales)
            {
                UsuariosSuscripciones::where('id_usuario',$idusuario)->delete();
            }
            //Guardamos info en usuarios suscripcion
            $usuariosSuscripcion = new UsuariosSuscripciones;
            $usuariosSuscripcion->id_usuario = $idusuario;
            $usuariosSuscripcion->id_tipo_membresia = $request->extra3;
            $usuariosSuscripcion->fecha_inicio = $fecha_inicio_suscripcion;
            $usuariosSuscripcion->fecha_fin = \Carbon\Carbon::now()->addDays($suscripcion->duracion);
            $usuariosSuscripcion->metodo_pago = 'payU';
            $usuariosSuscripcion->status = 'RECHAZADO';
            $usuariosSuscripcion->save();

        }

    }

}