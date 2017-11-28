<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Videovr;


class VideovrController extends Controller
{
    public function videos360()
    {
        try{
            $videosvr=Videovr::get(['titulo','descripcion','foto','video']);
            $data=[];
            foreach ($videosvr as $video) {
            	$data[]=[
            		'titulo' => $video->titulo,
            		'descripcion' => $video->descripcion,
            		'foto' => config('app.url') . 'videosvr/' . $video->foto,
            		'video' => config('app.url') . 'videosvr/' . $video->video,
            	];
            }
            return ["status"=>'exito', 'data' => $data];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
}
