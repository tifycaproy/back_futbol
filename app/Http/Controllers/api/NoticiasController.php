<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticia;
use App\Usuario;


class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token='')
    {
        if($token<>''){
            $idusuario=decodifica_token($token);
            if($idusuario<>''){
                Usuario::find($idusuario)->update([
                    'activo'=>1,
                    'ultimo_ingreso' => date('Y-m-d h:i'),
                ]);
            }
        }
        $noticias=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo')->where('active',1)->where('aparecetimelineppal',1)->orderby('fecha','desc','id')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticias as $noticia) {
            if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
            $data["data"][]=$noticia;
        }
        return $data;
    }
    public function fotos($id)
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
    public function noticias_monumentales()
    {
        $noticias=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo')->where('active',1)->where('aparevetimelinemonumentales','<>',0)->orderby('fecha','desc','id')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticias as $noticia) {
            if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
            $data["data"][]=$noticia;
        }
        return $data;
    }
    public function noticias_futbolbase()
    {
        $noticias=Noticia::select('id','link','titulo','descripcion','fecha','foto','destacada','tipo')->where('active',1)->where('aparecefutbolbase','<>',0)->orderby('fecha','desc','id')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticias as $noticia) {
            if($noticia->foto<>'') $noticia->foto=config('app.url') . 'noticias/' . $noticia->foto;
            $data["data"][]=$noticia;
        }
        return $data;
    }
}
