<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Encuesta;
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
        if($encuesta=Encuesta::whereDate('fecha_inicio','<=', date('Y-m-d'))->whereDate('fecha_fin','>=', date('Y-m-d'))->orderby('fecha_fin')->first()){
            $votos=EncuestaVotos::where('usuario_id',$idusuario)->where('encuesta_id',$encuesta->id)->count();
            $puedevotar=0;
            if($encuesta->tipo_voto<>'Único' or $votos==0) $puedevotar=1;
            //$puedevervotos=(($encuesta->mostrar_resultados=='Siempre') or )
            $data=[
                'idencuesta' => $encuesta->id,
                'titulo' => $encuesta->titulo,
                'fecha_inicio' => $encuesta->fecha_inicio,
                'fecha_fin' => $encuesta->fecha_fin,
                'puedevotar' => $puedevotar,
                'respuestas' => [],
            ];
            foreach ($encuesta->respuestas as $respuesta) {
                $data['respuestas'][]=[
                    'idrespuesta' => $respuesta->id,
                ];
            }
            return ["status" => "exito", "data" => $data];
        }else{
            return ['status' => 'fallo','error'=>["No hay encuestas activas"]];
        }

    }
}
