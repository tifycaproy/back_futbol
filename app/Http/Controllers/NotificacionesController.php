<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class NotificacionesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $secciones_destino=[
        'news','calendar','table','statistics','team','line_up','virtual_reality','football_base','store','academy','live','games','you_choose','profile','geolocalizacion','muro'
    ];


    return view('notificaciones.create')->with('secciones_destino',$secciones_destino);
}

public function enviar(Request $request)
{
    $usuarios = Usuario::where('notificacionToken','!=','')->get();
    $tokens = array();
    foreach($usuarios as $usuario){
        $tokens[] = $usuario->notificacionToken;
    }

    $message = $request->mensajeNotificacion;
            //Título de notificación
    $title = $request->tituloNotificacion;
            //Sección a la que se apunta
    $seccion = $request->seccionNotificacion;
            //ID del post
            //$id_post = '1';

            //Configuración FCM
    $path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
    $server_key = "AAAASVVoXPQ:APA91bE-kueGIF2y5Wmo8vvmWfYHsqp5RF8jE7hUVrkxy6ytmVDRSEvwUTfa7KrNm15NMR3xA4obbgwLUo4ZrV_z_VsBkh0p8AbvN7G8zcN2IDt-zI33SoUlOnxIhw_kQshisZRwKyLk";
            //Token de usuario FCM
    $headers = array(
        'Authorization:key=' .$server_key,
        'Content-Type:application/json'
    );
    
    $tokens = array_chunk($tokens, 1000);

    foreach($tokens as $tokenSnap)
    {
        $fields = array('registration_ids'=>$tokenSnap,
           'notification'=>array('title'=>$title,'body'=>$message),
           'data'=>array('seccion'=>$seccion,'id_post'=>'noAplica'));

        $payload = json_encode($fields);
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($curl_session);
    }
    $secciones_destino=[
        'news','calendar','table','statistics','team','line_up','virtual_reality','football_base','store','academy','live','games','you_choose','profile','geolocalizacion','muro'
    ];
    return view('notificaciones.create')->with('notificacion','Notificación enviada exitosamente')->with('secciones_destino',$secciones_destino);
}

}
