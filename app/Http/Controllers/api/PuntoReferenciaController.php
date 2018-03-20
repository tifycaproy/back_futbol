<?php

namespace App\Http\Controllers\api;

@session_start();
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\PuntoReferencia;
use App\PuntoReferenciaImagen;
use Illuminate\Support\Facades\Auth;
use Aws\S3\S3Client;
class PuntoReferenciaController extends Controller
{

    public function punto_referencia()
    {

        $data["status"]='exito';
        foreach (PuntoReferencia::all() as $punto ) {
            $data["data"][]=[
                'titulo' => $punto->nombre,
                'latitud' => $punto->cordy,
                'longitud' => $punto->cordx,
                'imagenes' => $punto->imagenes
            ];
        }
        return $data;
    }


}
