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
                "nombre" => $this->transliterateString($jugador->nombre),
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Defensa')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                'idjugador' => $jugador->id,
                "nombre" => $this->transliterateString($jugador->nombre),
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Volante')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                'idjugador' => $jugador->id,
                "nombre" => $this->transliterateString($jugador->nombre),
                "banner" => config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores = Jugador::where('activo', 1)->select('id', 'nombre', 'banner')->where('posicion', 'Delantero')->get();
        foreach ($judadores as $jugador) {
            $data['data'][] = [
                "idjugador" => $jugador->id,
                "nombre" => $this->transliterateString($jugador->nombre),
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
                    'estado' => $fecha->estado
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

                function transliterateString($txt) {
                    $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
                    return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
                }
            }
