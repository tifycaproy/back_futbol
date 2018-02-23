<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Mail;


class BorrarController extends Controller
{
    public function borrar()
    {

        $data=[
            "email"=>'reduque@hotmail.com',
            'nombre'=>'rafael Duque',
        ];

        Mail::send('emails.prueba', $data, function($message) use ($data) {
            $message->from('app@appmillonariosfc.com');
            $message->to($data['email'], $data['nombre'])->subject('Prueba de email');
        });

        echo 'listo';

    }

}
