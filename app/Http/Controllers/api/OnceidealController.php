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
            $data["usuario_id"]=$idusuario;
            $data["calendario_id"]=$idcalendario->calendario_alineacion_id;
            foreach ($request["jugadores"] as $key => $value) {
                $indice=$key+1;
                $data['idjugador' . $indice]=$value->idjugador;
                $data['x' . $indice]=$value->x;
                $data['y' . $indice]=$value->y;
            }
            if($idonce=Onceideal::where('calendario_id',$idcalendario->calendario_alineacion_id)->where("usuario_id",$idusuario)->first()){
            	$idonce->update($data);
            }else{
            	Onceideal::create($data);
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
            if($idonce=Onceideal::where('calendario_id',$idcalendario->calendario_alineacion_id)->where("usuario_id",$idusuario)->first()){
                //"idjugador1","x1","y1"
                $data=[];
                for($l=1; $l<=11; $l++){
                    $data[]=[
                        "idjugador"=>$idonce["idjugador" . $l],
                        "x"=>$idonce["x" . $l],
                        "y"=>$idonce["y" . $l],
                    ];
                }
	            return ["status" => "exito", "data" => $data];
            	$idonce->update($request);
            }else{
	            return ['status' => 'fallo','error'=>["No tiene once ideal cargado"]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenmte de nuevo"]];
        }
    }
}
