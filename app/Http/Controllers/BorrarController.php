<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Mail;


class BorrarController extends Controller
{
    public function borrar()
    {

$formacion_id=1;

$posiciones=[];
$posiciones[1]=[
    'x' => 14,
    'y' => 191,
];
switch ($formacion_id) {
    case 1:
        $posiciones[2]=['x' => 14,'y' => 353];
        $posiciones[3]=['x' => 128,'y' => 28];
        $posiciones[4]=['x' => 128,'y' => 244];
        $posiciones[5]=['x' => 128,'y' => 126];
        $posiciones[6]=['x' => 241,'y' => 191];
        $posiciones[7]=['x' => 418,'y' => 353];
        $posiciones[8]=['x' => 268,'y' => 317];
        $posiciones[9]=['x' => 418,'y' => 191];
        $posiciones[10]=['x' => 268,'y' => 84];
        $posiciones[11]=['x' => 418,'y' => 28];

        break;
}
$imagen1=asset('/compartir/images/cancha.jpg');
$imagen2='http://cmsmillos.s3-website-us-east-1.amazonaws.com/jugadores/201711171312343.png';  //i2="../img/imagen1.png"
$imagen3='http://cmsmillos.s3-website-us-east-1.amazonaws.com/jugadores/201711171810316.png';  //i3="../img/imagen2.png"

$img1 = imagecreatefromjpeg($imagen1); //Se indica la imagen "base"
$img2 = imagecreatefrompng($imagen2); // Se indican las imagenes a añadir
$img3 = imagecreatefrompng($imagen3);

for($l=1; $l<=11; $l++){
    imagecopyresampled(
        $img1,
        $img2,
        $posiciones[$l]['x'], $posiciones[$l]['y'], 0, 0,
        50,
        50,
        imagesx($img2),
        imagesy($img2)
    );
}

ob_clean();
ob_start();
//header('Content-Type: image/jpeg');
imagejpeg($img1, null, 100);

$data = ob_get_contents();
ob_end_clean();
if( !empty( $data ) ) {

    $data = base64_encode( $data );

    // Check for base64 errors
    if ( $data !== false ) {

        // Success
        return "<img src='data:image/jpeg;base64,$data'>";
    }
}


imagedestroy($img1);
imagedestroy($img2);
imagedestroy($img3);




    }

}
