<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticia;


class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
}
