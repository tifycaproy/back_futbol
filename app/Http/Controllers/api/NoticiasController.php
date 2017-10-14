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
        $noticias=Noticia::where('active',1)->orderby('fecha','desc','id')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($noticias as $noticia) {
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
                'foto' => config('app.url') . $foto->foto,
            ];
        }
        return $data;
    }
}
