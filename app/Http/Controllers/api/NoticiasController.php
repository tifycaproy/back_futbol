<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuracion;
use App\Noticia;
use App\Usuario;
use App\Copa;
use App\Calendario;


class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$token='')
    {
        $id_partido_banner = Configuracion::first(['id_partido_banner']);
        $copa=Calendario::find($id_partido_banner);
        $copa=[
            'idpartido'=>$copa[0]->id,
            "estado"=>$copa[0]->estado,
            "equipo_1"=>$copa[0]->equipo1->nombre,
            "bandera_1"=>config('app.url') . 'equipos/' . $copa[0]->equipo1->bandera,
            "goles_1"=>$copa[0]->goles_1,
            "equipo_2"=>$copa[0]->equipo2->nombre,
            "bandera_2"=>config('app.url') . 'equipos/' . $copa[0]->equipo2->bandera,
            "goles_2"=>$copa[0]->goles_2,
            'fecha'=>$copa[0]->fecha,
            'fecha_etapa'=>$copa[0]->fecha_etapa,
            'estadio'=>$copa[0]->estadio,
            'info'=>$copa[0]->info,
        ];
        if($token<>''){
            $idusuario=decodifica_token($token);
            if($idusuario<>''){
                Usuario::find($idusuario)->update([
                    'activo'=>1,
                    'ultimo_ingreso' => date('Y-m-d h:i'),
                ]);
            }
        }

        $noticias=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo', 'dorado')
        ->where('active',1)
        ->where('aparecetimelineppal',1)
        ->orderby('fecha','desc','id')
        ->paginate(25);

        $data["status"]='exito';
        $data["partido"]= $copa;
        $data["data"]=[];
        foreach ($noticias as $noticia) {
            if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
            $data["data"][]=$noticia;
        }



        return $data;
    }
    public function fotos(Request $request, $id)
    {
        $noticia=Noticia::find($id);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticia->fotos as $foto) {
            $data["data"][]=[
                'titulo' => $foto->titulo,
                'foto' => config('app.url') . 'noticias/' . $foto->foto,
            ];
        }
        return $data;
    }
    public function noticias_monumentales(Request $request)
    {

        $noticias=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo', 'dorado')->where('active',1)->where('aparevetimelinemonumentales','<>',0)->orderby('fecha','desc','id')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticias as $noticia) {
            if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
            $data["data"][]=$noticia;
        }
        return $data;
    }
    public function noticias_futbolbase(Request $request)
    {

        $noticias=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo', 'dorado')->where('active',1)->where('aparecefutbolbase','<>',0)->orderby('fecha','desc','id')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticias as $noticia) {
            if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
            $data["data"][]=$noticia;
        }
        return $data;
    }

    public function single_noticia($idNoticia){

       $noticia=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo', 'dorado')
       ->where('id',$idNoticia);

       $data["status"]='exito';
       $data["data"]=[];
       if($noticia->foto<>'') 
        $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
    $data["data"][]=$noticia;   

    return $data;


}
}
