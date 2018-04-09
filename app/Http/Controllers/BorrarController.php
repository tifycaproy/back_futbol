<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Mail;


class BorrarController extends Controller
{
    public function borrar()
    {


$imagen1=asset('/compartir/images/cancha.jpg');
$imagen2='http://cmsmillos.s3-website-us-east-1.amazonaws.com/jugadores/201711171312343.png';  //i2="../img/imagen1.png"
$imagen3='http://cmsmillos.s3-website-us-east-1.amazonaws.com/jugadores/201711171810316.png';  //i3="../img/imagen2.png"

/*
$img1 = imagecreatefromjpeg($imagen1); //Se indica la imagen "base"
$img2 = imagecreatefrompng($imagen2); // Se indican las imagenes a añadir
$img3 = imagecreatefrompng($imagen3);


imagecopyresampled(
$img1,
$img2,
100, 100, 0, 0,
50,
50,
imagesx($img2),
imagesy($img2)
);


header('Content-Type: image/jpeg');
imagejpeg($img1, null, 100);

imagedestroy($img1);
imagedestroy($img2);
imagedestroy($img3);
*/

$nombre_archivo = $imagen1;
$porcentaje = 0.5;


// Obtener nuevas dimensiones
list($ancho, $alto) = getimagesize($nombre_archivo);
$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;
// Redimensionar
$imagen_p = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
$imagen = imagecreatefromjpeg($nombre_archivo);
imagecopyresampled($imagen_p, $imagen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

// Imprimir
header('Content-Type: image/jpeg');
imagejpeg($imagen, null, 100);




    }

}
