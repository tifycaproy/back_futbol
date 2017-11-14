<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jugadorfb;



class JugadoresfbController extends Controller
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
        $judadores=Jugadorfb::where('activo',1)->select('id','banner')->where('posicion','Portero')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjugador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores=Jugadorfb::where('activo',1)->select('id','banner')->where('posicion','Defensa')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjugador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores=Jugadorfb::where('activo',1)->select('id','banner')->where('posicion','Volante')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjugador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        $judadores=Jugadorfb::where('activo',1)->select('id','banner')->where('posicion','Delantero')->get();
        foreach ($judadores as $jugador){
            $data['data'][]=[
                'idjugador' => $jugador->id,
                "banner"=>config('app.url') . 'jugadores/' . $jugador->banner,
            ];
        }
        return $data;
    }
    public function single_jugadorfb($id)
    {
        if($jugador=Jugadorfb::find($id)){
            $data["status"]='exito';
            $data["data"]=[
                'idjugador' => $jugador->id,
                'nombre' => $jugador->nombre,
                'fecha_nacimiento' => $jugador->fecha_nacimiento,
                'nacionalidad' => $jugador->nacionalidad,
                'n_camiseta' => $jugador->n_camiseta,
                'posicion' => $jugador->posicion,
                'peso' => $jugador->peso,
                'estatura' => $jugador->estatura,
                'banner'=>config('app.url') . 'jugadores/' . $jugador->banner,
                'instagram' => $jugador->instagram,
            ];

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
}
