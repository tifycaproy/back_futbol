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
use Carbon\Carbon;
class PuntoReferenciaController extends Controller
{

    public function punto_referencia()
    {

        $data["status"]='exito';
        foreach (PuntoReferencia::all() as $punto ) {
            $data["data"][]=[
                'id' => $punto->id,
                'titulo' => $punto->nombre,
                'latitud' => $punto->cordx,
                'longitud' => $punto->cordy,
                'direccion' => $punto->direccion,
                'ciudad' => $punto->ciudad,
                'pais' => $punto->pais,
                'fecha_evento' => Carbon::parse($punto->hora_evento)->format('Y-m-d'),
                'hora' => Carbon::parse($punto->hora_evento)->format('G:i'),
                'imagenes' => $punto->imagenes
            ];
        }
        return $data;
    }


}
