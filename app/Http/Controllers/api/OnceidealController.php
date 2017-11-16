<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Onceideal;
use App\Configuracion;


class OnceidealController extends Controller
{
    public function guardar_once(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $token=$request["token"];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $idcalendario=Configuracion::first(["calendario_alineacion_id"]);
            $request["usuario_id"]=$idusuario;
            $request["calendario_id"]=$idcalendario->calendario_alineacion_id;
            unset($request["token"]);
            if($idonce=Onceideal::where('calendario_id',$idcalendario->calendario_alineacion_id)->where("usuario_id",$idusuario)->first()){
            	$idonce->update($request);
            }else{
            	Onceideal::create($request);
            }
            return ["status" => "exito"];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenmte de nuevo"]];
        }
    }
    public function leer_once($token)
    {
        try{
            //Validaciones
            $errors=[];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $idcalendario=Configuracion::first(["calendario_alineacion_id"]);
            if($idonce=Onceideal::where('calendario_id',$idcalendario->calendario_alineacion_id)->where("usuario_id",$idusuario)->first(["idjugador1","x1","y1","idjugador2","x2","y2","idjugador3","x3","y3","idjugador4","x4","y4","idjugador5","x5","y5","idjugador6","x6","y6","idjugador7","x7","y7","idjugador8","x8","y8","idjugador9","x9","y9","idjugador10","x10","y10","idjugador11","x11","y11"])){
	            return ["status" => "exito", "data" => $idonce];
            	$idonce->update($request);
            }else{
	            return ['status' => 'fallo','error'=>["No tiene once ideal cargado"]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenmte de nuevo"]];
        }
    }
}
