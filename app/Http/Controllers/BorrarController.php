<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Mail;


class BorrarController extends Controller
{
    public function borrar()
    {

$formacion_id=4;

$posiciones=[];
$posiciones[1]=[
    'x' => 14,
    'y' => 181,
];
switch ($formacion_id) {
    case 1:
        //433
        $posiciones[2]=['x' => 128,'y' => 343];
        $posiciones[3]=['x' => 128,'y' => 18];
        $posiciones[4]=['x' => 128,'y' => 234];
        $posiciones[5]=['x' => 128,'y' => 116];
        $posiciones[6]=['x' => 241,'y' => 181];
        $posiciones[7]=['x' => 418,'y' => 343];
        $posiciones[8]=['x' => 268,'y' => 307];
        $posiciones[9]=['x' => 418,'y' => 171];
        $posiciones[10]=['x' => 268,'y' => 64];
        $posiciones[11]=['x' => 418,'y' => 18];
        break;
    case 2:
        //442
        $posiciones[2]=['x' => 128,'y' => 343];
        $posiciones[3]=['x' => 128,'y' => 18];
        $posiciones[4]=['x' => 128,'y' => 234];
        $posiciones[5]=['x' => 128,'y' => 116];
        $posiciones[6]=['x' => 241,'y' => 234];
        $posiciones[7]=['x' => 268,'y' => 343];
        $posiciones[8]=['x' => 241,'y' => 116];
        $posiciones[9]=['x' => 418,'y' => 116];
        $posiciones[10]=['x' => 418,'y' => 234];
        $posiciones[11]=['x' => 268,'y' => 18];
        break;
    case 3:
        //551
        $posiciones[2]=['x' => 128,'y' => 343];
        $posiciones[3]=['x' => 128,'y' => 18];
        $posiciones[4]=['x' => 128,'y' => 234];
        $posiciones[5]=['x' => 128,'y' => 116];
        $posiciones[6]=['x' => 241,'y' => 181];
        $posiciones[7]=['x' => 268,'y' => 348];
        $posiciones[8]=['x' => 241,'y' => 265];
        $posiciones[9]=['x' => 418,'y' => 181];
        $posiciones[10]=['x' => 241,'y' => 97];
        $posiciones[11]=['x' => 268,'y' => 14];
        break;
    case 4:
        //4411
        $posiciones[2]=['x' => 128,'y' => 343];
        $posiciones[3]=['x' => 128,'y' => 18];
        $posiciones[4]=['x' => 128,'y' => 234];
        $posiciones[5]=['x' => 128,'y' => 116];
        $posiciones[6]=['x' => 241,'y' => 234];
        $posiciones[7]=['x' => 268,'y' => 343];
        $posiciones[8]=['x' => 241,'y' => 116];
        $posiciones[9]=['x' => 455,'y' => 181];
        $posiciones[10]=['x' => 350,'y' => 181];
        $posiciones[11]=['x' => 268,'y' => 18];
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
        70,
        70,
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
