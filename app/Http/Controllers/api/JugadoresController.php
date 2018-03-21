<?php

namespace App\Http\Controllers\api;

use App\Aplauso;
use App\Configuracion;
use App\Http\Controllers\Controller;
use App\Jugador;
use Illuminate\Http\Request;


class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nomina()
    {
        $data["status"] = 'exito';
        $data["data"] = [];
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Portero')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                'idjugador' => $jugador->id,
                "nombre" => $jugador->nombre,
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Defensa')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                'idjugador' => $jugador->id,
                "nombre" => $jugador->nombre,
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Volante')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                'idjugador' => $jugador->id,
                "nombre" => $jugador->nombre,
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Delantero')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                "djugador" => $jugador->id,
                "nombre" => $jugador->nombre,
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        return $data;
    }

    public function single_jugador($id, $token = null)
    {
        
        $ultimo_aplauso = 0;
        if ($jugador = Jugador::find($id)) {
            if($token != null){
                $idusuario=decodifica_token($token);
                if(!empty($jugador->alineacion->last())){
                    $aplauso = Aplauso::where('calendario_id', $jugador->alineacion->last()->calendario_id)->where('jugadores_id', $id)->where('usuario_id', $idusuario)->get();
                    if(count($aplauso) > 0){
                        $ultimo_aplauso = 1;
                    }else{
                        $ultimo_aplauso = 0;
                    }
                }
            }

            $data["status"] = 'exito';
            $data["data"] = [
                'idjugador' => $jugador->id,
                'nombre' => $jugador->nombre,
                'fecha_nacimiento' => $jugador->fecha_nacimiento,
                'nacionalidad' => $jugador->nacionalidad,
                'n_camiseta' => $jugador->n_camiseta,
                'posicion' => $jugador->posicion,
                'peso' => $jugador->peso,
                'estatura' => $jugador->estatura,
                'banner' => config('app.url') . 'jugadores/' . $jugador->banner,
                'instagram' => $jugador->instagram,
                'ultimo_aplauso' => $ultimo_aplauso
            ];
            $partidoaaplaudor = Configuracion::first(['calendario_aplausos_id']);
            if ($partidoaaplaudor->calendario_aplausos_id <> 0 and $partidoaaplaudor->calendario_aplausos_id == $jugador->calendario_id) {
                $data["data"]['sepuedeaplaudir'] = 1;
            } else {
                $data["data"]['sepuedeaplaudir'] = 0;
            }

            if ($fecha = $jugador->fecha) {
                $partido = [
                    'idpartido' => $fecha->id,
                    "equipo_1" => $fecha->equipo1->nombre,
                    "bandera_1" => config('app.url') . 'equipos/' . $fecha->equipo1->bandera,
                    "goles_1" => $fecha->goles_1,
                    "equipo_2" => $fecha->equipo2->nombre,
                    "bandera_2" => config('app.url') . 'equipos/' . $fecha->equipo2->bandera,
                    "goles_2" => $fecha->goles_2,
                    'fecha' => $fecha->fecha,
                    'fecha_etapa' => $fecha->fecha_etapa,
                    'estadio' => $fecha->estadio,
                ];
                $data["data"] = array_merge($data["data"], $partido);
            } else {
                $data["data"]['idpartido'] = null;
            }
            /*
                        if($jugador->calendario_id<>0){
                            $data["data"]['apalusos_ultimo_partido'] = Aplauso::where('calendario_id',$jugador->calendario_id)->where('jugadores_id',$id)->count();
                        }else{
                            $data["data"]['apalusos_ultimo_partido'] = 0;
                        }
            */
            $idcalendario = $partidoaaplaudor->calendario_aplausos_id;
            if ($idcalendario == 0) {
                if ($partidoaaplaudor = Aplauso::orderby('created_at', 'desc')->first(['calendario_id'])) {
                    $idcalendario = $partidoaaplaudor->calendario_id;
                }
            }
            $data["data"]['apalusos_ultimo_partido'] = Aplauso::where('calendario_id', $idcalendario)->where('jugadores_id', $id)->count();

            $data["data"]['aplausos_acumulado'] = Aplauso::where('jugadores_id', $id)->count();

            $noticias = $jugador->noticias;
            $data["data"]['noticias'] = [];
            foreach ($noticias as $noticia) {
                if ($noticia->foto <> '') $noticia->foto = config('app.url') . 'noticias/' . $noticia->foto;
                unset($noticia->pivot);
                $data["data"]['noticias'][] = $noticia;
            }

        } else {
            $data["status"] = 'fallo';
            $data["error"] = ['idjugador incorrecto'];
        }
        return $data;
    }

    public function aplaudir(Request $request)
    {
        $request = json_decode($request->getContent());
        $request = get_object_vars($request);

        try {
            //Validaciones
            $errors = [];
            if (!isset($request["idjugador"])) $errors[] = "El idjugador es requerido";
            if (!isset($request["imei"])) $errors[] = "El imei es requerido";
            if (!isset($request["idpartido"])) $errors[] = "El idpartido es requerido";
            if (count($errors) > 0) {
                return ["status" => "fallo", "error" => $errors];
            }
            $idusuario = null;
            if(isset($request["token"])){
                $idusuario=decodifica_token($request["token"]);
            }
            
            if ($aplauso = Aplauso::where('jugadores_id', $request["idjugador"])->where('calendario_id', $request["idpartido"])->where('imei', $request["imei"])->first()) {
                $aplauso->delete();
                $aplauso = 0;
            } else {
                Aplauso::create([
                    'jugadores_id' => $request["idjugador"],
                    'calendario_id' => $request["idpartido"],
                    'imei' => $request["imei"],
                    'usuario_id' => $idusuario
                ]);
                $aplauso = 1;
            }
            //fin validaciones
            return ["status" => "exito","aplauso" => $aplauso ];
        } catch (Exception $e) {
            return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
}
