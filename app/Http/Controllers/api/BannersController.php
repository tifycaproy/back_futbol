<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;


class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::get(['seccion','target','url','seccion_destino','foto']);

        $data["status"]='exito';
        $data["data"]=$banners;
 
        foreach($data["data"] as &$banner){
            if($banner["foto"]<>''){
                $banner['foto']=config('app.url') . 'banners/' . $banner['foto'];
            }
        }
        return $data;
    }
}
