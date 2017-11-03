<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jugador;
use App\Aplauso;
use App\Configuracion;



class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nomina()
    {
        $data["status"]='exito';
        $data["data"]=[];
        $judadores=Jugador::where('activo',1)->select('id','banner')->where('posicion','Portero')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjudador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores=Jugador::where('activo',1)->select('id','banner')->where('posicion','Defensa')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjudador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores=Jugador::where('activo',1)->select('id','banner')->where('posicion','Volante')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjudador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores=Jugador::where('activo',1)->select('id','banner')->where('posicion','Delantero')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjudador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        return $data;
    }
    public function single_jugador($id)
    {
        if($jugador=Jugador::find($id)){
            $data["status"]='exito';
            $data["data"]=[
                'idjudador' => $jugador->id,
                'nombre' => $jugador->nombre,
                'fecha_nacimiento' => $jugador->fecha_nacimiento,
                'nacionalidad' => $jugador->nacionalidad,
                'n_camiseta' => $jugador->n_camiseta,
                'posicion' => $jugador->posicion,
                'banner'=>config('app.url') . 'jugadores/' . $jugador->banner,
                'instagram' => $jugador->instagram,
            ];
            $partidoaaplaudor=Configuracion::first(['calendario_aplausos_id']);
            if($partidoaaplaudor->calendario_aplausos_id<>0 and $partidoaaplaudor->calendario_aplausos_id==$jugador->calendario_id){
                $data["data"]['sepuedeaplaudir'] = 1;
            }else{
                $data["data"]['sepuedeaplaudir'] = 0;
            }

            if($fecha=$jugador->fecha){
                $partido=[
                    'idpartido'=>$fecha->id,
                    "equipo_1"=>$fecha->equipo1->nombre,
                    "bandera_1"=>config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                    "goles_1"=>$fecha->goles_1,
                    "equipo_2"=>$fecha->equipo2->nombre,
                    "bandera_2"=>config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
                    "goles_2"=>$fecha->goles_2,
                    'fecha'=>$fecha->fecha,
                    'fecha_etapa'=>$fecha->fecha_etapa,
                    'estadio'=>$fecha->estadio,
                ];
                $data["data"] = array_merge($data["data"], $partido);
            }else{
                $data["data"]['idpartido'] = null;
            }

            if($jugador->calendario_id<>0){
                $data["data"]['apalusos_ultimo_partido'] = Aplauso::where('calendario_id',$jugador->calendario_id)->where('jugadores_id',$id)->count();
            }else{
                $data["data"]['apalusos_ultimo_partido'] = 0;
            }
            $data["data"]['aplausos_acumulado']=Aplauso::where('jugadores_id',$id)->count();

            $noticias=$jugador->noticias;
            $data["data"]['noticias']=[];
            foreach ($noticias as $noticia) {
                if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
                unset($noticia->pivot);
                $data["data"]['noticias'][]=$noticia;
            }

        }else{
            $data["status"]='fallo';
            $data["error"]=['idjugador incorrecto'];
        }
        return $data;
    }
    public function aplaudir(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            if(!isset($request["idjudador"])) $errors[]="El idjudador es requerido";
            if(!isset($request["imei"])) $errors[]="El imei es requerido";
            if(!isset($request["idpartido"])) $errors[]="El idpartido es requerido";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            if(Aplauso::where('jugadores_id',$request["idjudador"])->where('calendario_id',$request["idpartido"])->where('imei',$request["imei"])->first()){
                return ["status" => "fallo", "error" => ["Usted ya aplaudió a este jugador en este partido"]];
            }

            //fin validaciones
            Aplauso::create([
                'jugadores_id'=>$request["idjudador"],
                'calendario_id'=>$request["idpartido"],
                'imei'=>$request["imei"],
            ]);

            return ["status" => "exito"];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenmte de nuevo"]];
        } 
    }
}
