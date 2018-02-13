<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Encuesta;
use App\EncuestaRespuesta;
use App\EncuestaVotos;

class EncuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function encuesta($token)
    {
        //Validaciones
        $errors=[];
        $idusuario=decodifica_token($token);
        if($idusuario=="") $errors[]="El token es incorrecto";
        if(count($errors)>0){
            return ["status" => "fallo", "error" => $errors];
        }
        //fin validaciones
        if($encuesta=Encuesta::where('activa',1)->whereDate('fecha_inicio','<=', date('Y-m-d'))->orderby('fecha_fin')->first()){
            $votos=EncuestaVotos::where('usuario_id',$idusuario)->where('encuesta_id',$encuesta->id)->count();
            $puedevotar=(($encuesta->tipo_voto<>'Único' or $votos==0) and strtotime(date('Y-m-d',strtotime($encuesta->fecha_fin))) >= strtotime(date('Y-m-d'))) ? 1 : 0;
            $puedevervotos=($encuesta->mostrar_resultados=='Siempre' or ($encuesta->mostrar_resultados=='Solo si ya votó' and $votos>0) or strtotime(date('Y-m-d',strtotime($encuesta->fecha_fin))) < strtotime(date('Y-m-d'))) ? 1 : 0;
            $data=[
                'idencuesta' => $encuesta->id,
                'titulo' => $encuesta->titulo,
                'fecha_inicio' => $encuesta->fecha_inicio,
                'fecha_fin' => $encuesta->fecha_fin,
                'puedevotar' => $puedevotar,
                'puedevervotos' => $puedevervotos,
                'respuestas' => [],
            ];
            foreach ($encuesta->respuestas as $respuesta){
                if($encuesta->tipo_voto=='Múltiple libre'){
                    $yavoto=0;
                }else{
                    $yavoto=EncuestaVotos::where('respuesta_id',$respuesta->id)->where('usuario_id', $idusuario)->first() ? 1 : 0 ;
                }
                $data['respuestas'][]=[
                    'idrespuesta' => $respuesta->id,
                    'respuesta' => $respuesta->respuesta,
                    'foto'=>config('app.url') . 'respuestas/' . $respuesta->foto,
                    'yavoto' => $yavoto,
                ];
            }
            return ["status" => "exito", "data" => $data];
        }else{
            return ['status' => 'fallo','error'=>["No hay encuestas activas"]];
        }

    }
    public function encuesta_votar(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $idusuario=decodifica_token($request["token"]);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["idencuesta"])) $errors[]="El idencuesta es requerido";
            if(!isset($request["idrespuesta"])) $errors[]="El idrespuesta es requerido";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $encuesta=Encuesta::find($request["idencuesta"]);
            $votos=EncuestaVotos::where('usuario_id',$idusuario)->where('encuesta_id',$encuesta->id)->count();
            if((($encuesta->tipo_voto<>'Único' or $votos==0) and strtotime(date('Y-m-d',strtotime($encuesta->fecha_fin))) >= strtotime(date('Y-m-d')))){
                if(!($encuesta->tipo_voto=='Múltiple simple' and EncuestaVotos::where('usuario_id',$idusuario)->where('respuesta_id',$request["idrespuesta"])->first())){
                    EncuestaVotos::create([
                        'encuesta_id' => $request["idencuesta"],
                        'respuesta_id' => $request["idrespuesta"],
                        'usuario_id' => $idusuario,
                    ]);
                    EncuestaRespuesta::find($request["idrespuesta"])->update([
                        'votos' => EncuestaVotos::where('respuesta_id',$request["idrespuesta"])->count()
                    ]);
                }
            }
            $data=[
                'puedevervotos' =>
                ($encuesta->mostrar_resultados<>'Al finalizar la encuesta' or strtotime(date('Y-m-d',strtotime($encuesta->fecha_fin))) < strtotime(date('Y-m-d'))) ? 1 : 0,
            ];                
            return ["status" => "exito", "data" => $data];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function single_respuesta($id)
    {
        if($respuesta=EncuestaRespuesta::find($id)){
            $data["status"]='exito';
            $data["data"]=[
                'respuesta' => $respuesta->respuesta,
                'banner'=>config('app.url') . 'respuestas/' . $respuesta->banner,
                'votos' => $respuesta->votos,
            ];
            $noticias=$respuesta->noticias;
            $data["data"]['noticias']=[];
            foreach ($noticias as $noticia) {
                if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
                unset($noticia->pivot);
                $data["data"]['noticias'][]=$noticia;
            }

        }else{
            $data["status"]='fallo';
            $data["error"]=['idrespuesta incorrecto'];
        }
        return $data;
    }
    public function ranking_encuestas($id)
    {
        $respuestas=EncuestaRespuesta::where('encuesta_id',$id)->where('votos','<>',0)->orderby('votos','desc')->get();
        foreach ($respuestas as $respuesta) {
            $data['respuestas'][]=[
                'idrespuesta' => $respuesta->id,
                'respuesta' => $respuesta->respuesta,
                'votos' => $respuesta->votos,
                'miniatura'=>config('app.url') . 'respuestas/' . $respuesta->miniatura,
            ];
        }

        return $data;
    }
}
