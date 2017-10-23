<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Monumental;
use App\MonumentalEncuesta;
use App\MonumentalVotos;
use App\MonumentalAnual;



class MonumentalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function monumentales_encuesta()
    {
        if($encuesta=MonumentalEncuesta::where("activa",1)->first()){
            $data["status"]='exito';
            $data["data"]=[
                'idencuesta' => $encuesta->id,
                'titulo' => $encuesta->titulo,
                'fecha_fin' => $encuesta->fecha_fin,
                'total_votos' => $encuesta->votos->count(),
            ];
            foreach($encuesta->monumentales as $monumental){
                $data["data"]["monumentales"][]=[
                    'idmonumental' => $monumental->id,
                    'nombre' => $monumental->nombre,
                    "banner"=>config('app.url') . 'monumentales/' . $monumental->banner,
                ];
            }
            return $data;
        }else{
            return ['status' => 'fallo','error'=>["No hay encuestas activas"]];
        }
    }
    public function single_monumental($id)
    {
        if($monumental=Monumental::find($id)){
            $data["status"]='exito';
            $data["data"]=[
                'nombre' => $monumental->nombre,
                'foto'=>config('app.url') . 'monumentales/' . $monumental->foto,
                'total_votos' => $monumental->votos->count(),
                'instagram' => $monumental->instagram,
            ];

            $noticias=$monumental->noticias;
            $data["data"]['noticias']=[];
            foreach ($noticias as $noticia) {
                if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
                unset($noticia->pivot);
                $data["data"]['noticias'][]=$noticia;
            }

            return $data;
        }else{
            return ['status' => 'fallo','error'=>["idmonumental incorrecto"]];
        }
    }
    public function votar_monumental(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            if(!isset($request["idencuesta"])) $errors[]="El idencuesta es requerido";
            if(!isset($request["idmonumental"])) $errors[]="El idmonumental es requerido";
            if(!isset($request["imei"])) $errors[]="El imei es requerido";
            if(count($errors)>0){
                return ['status' => 'fallo','error'=>["No hay encuestas activas"]];
            }
            //fin validaciones
            //valido voto repetido
            if(MonumentalVotos::
                where('monumental_encuesta_id',$request["idencuesta"])
                ->where('monumental_id',$request["idmonumental"])
                ->where('imei',$request["imei"])
                ->first()){
                return ['status' => 'fallo','error'=>["Usted ya ha votado por esta monumental"]];
            }
            MonumentalVotos::create([
                'monumental_encuesta_id'=>$request["idencuesta"],
                'monumental_id'=>$request["idmonumental"],
                'imei'=>$request["imei"],
            ]);

            return ["status" => "exito"];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenmte de nuevo"]];
        } 
    }
    public function monumentales_anuales()
    {
        $data["status"]='exito';
        $data['data']=[];
        $monumentales=MonumentalAnual::select('nombre','banner')->get();
        foreach ($monumentales as $monumental){
            $data["data"][]=[
                "nombre"=>$monumental->nombre,
                "banner"=>config('app.url') . 'monumentales/' . $monumental->banner,
            ];
        }
        return $data;
    }
    public function ranking_monumentales()
    {
        $total_votos=MonumentalVotos::count();
        $data["status"]='exito';
        $monumentales=[];
        $votos=[];
        foreach (Monumental::get() as $monumental) {
            if($monumental->votos->count()>0){
                $mitot=$monumental->votos->count();
                $monumentales[]=[
                    'idmonumental' => $monumental->id,
                    'nombre' => $monumental->nombre,
                    'miniatura'=>config('app.url') . 'monumentales/' . $monumental->miniatura,
                    'total_votos' => $mitot,
                    'porcentaje' => round(100 * $mitot / $total_votos,2),
                ];
                $votos[]=$mitot;
            }
        }
        array_multisort($votos, SORT_DESC, $monumentales);
        $data["data"]=$monumentales;
        return $data;
    }
}
