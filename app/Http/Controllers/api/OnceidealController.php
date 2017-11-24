<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use App\Http\Controllers\Controller;

use App\Onceideal;
use App\Configuracion;
use App\Usuario;


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

            if(isset($request["foto"])){
                $foto=$request["foto"];
                if($foto<>''){
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                    $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                    $filepath='onceideal/' . $request["foto"];

                    $s3 = S3Client::factory(config('app.s3'));
                    $result = $s3->putObject(array(
                        'Bucket' => config('app.s3_bucket'),
                        'Key' => $filepath,
                        'SourceFile' => $foto,
                        'ContentType' => 'image',
                        'ACL' => 'public-read',
                    ));
                    $data["foto"]=$request["foto"];
                }
            }


            if($idonce=Onceideal::where('calendario_id',$idcalendario->calendario_alineacion_id)->where("usuario_id",$idusuario)->first()){
            	$idonce->update($data);
            }else{
            	Onceideal::create($data);
            }
            unset($data);
            $usuario=Usuario::find($idusuario,["apodo"]);
            if($usuario['apodo']<>''){
                $data["url"]=config('app.share_url') . 'compartir/onceideal/' . $usuario['apodo'];
            }else{
                $data["url"]=config('app.share_url') . 'compartir/onceideal/' . $idusuario;
            }
            return ["status" => "exito", "data" => $data];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
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
                    $data['jugadores'][]=[
                        "idjugador"=>$idonce["idjugador" . $l],
                        "x"=>$idonce["x" . $l],
                        "y"=>$idonce["y" . $l],
                    ];
                }
                $usuario=Usuario::find($idusuario,["apodo"]);
                if($usuario['apodo']<>''){
                    $data["url"]=config('app.share_url') . 'compartir/onceideal/' . $usuario['apodo'];
                }else{
                    $data["url"]=config('app.share_url') . 'compartir/onceideal/' . $idusuario;
                }
	            return ["status" => "exito", "data" => $data];
            	$idonce->update($request);
            }else{
	            return ['status' => 'fallo','error'=>["No tiene once ideal cargado"]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
}
