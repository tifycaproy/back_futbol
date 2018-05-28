<?php


class PostCest
{
    public $token_for_test;
    // Registro
    public function registro(ApiTester $I)
    {
        //REGISTRO

        /*$user0 = [
            'email' => 'user99@laplanamartinez.com',
            'nombre' => 'user99',
            'clave' => '123456',
            'estatus' => 'ACTIVO',
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/usuarios', $user0);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->assertTrue($response->status == 'exito');*/
    }

     // Auth
     public function auth(ApiTester $I)
     {
        //auth
         $user0 = [
            'email' => 'user0@laplanamartinez.com',
            "clave" => "user0",
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');

         //Login user0
         $I->sendPOST('/api/auth', $user0);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         $I->assertTrue($response->status == 'exito');
         $this->token_for_test = $response->data->token;
 
     }

    

     public function registro2(ApiTester $I)
    {
        //REGISTRO2
/*
        $user0 = [
            'email' => 'user77@laplanamartinez.com',
            'nombre' => 'user77',
            "clave" => "123456",
            "ci" => "24455331",
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/usuarios2', $user0);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->assertTrue($response->status == 'exito');
        $token_for_test = $response->data->token;*/

    }

    public function validar_cuenta(ApiTester $I)
    {
        //Validar cuenta

        $body = [
            'email' => 'user95@laplanamartinez.com',
            'pin' => '1234',
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/validar_cuenta', $body);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->assertTrue($response->status == 'fallo');

    }

    // Auth2
    public function auth2(ApiTester $I)
    {
       //auth2
        $user0 = [
           'email' => 'user0@laplanamartinez.com',
           "clave" => "user0",
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        //Login user0
        $I->sendPOST('/api/auth2', $user0);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        $token_for_test = $response->data->token;

    }
    

    // Auth_redes
    public function auth_redes(ApiTester $I)
    {
       //auth_redes
       /* $user0 = [
           'email' => 'ricardodpds2112@gmail.com',
           'nombre' => 'Ricardo',
           'userID_google' => '1234',
           'estatus' => 'ACTIVO',
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        //Login user0
        $I->sendPOST('/api/auth_redes', $user0);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        $token_for_test = $response->data->token;*/

    }

     // Recuperar clave
     public function recuperar_clave(ApiTester $I)
     {
        //recuperar clave
        /* $body = [
            'email' => 'user0@laplanamartinez.com',
        ];
 
        $I->haveHttpHeader('Content-Type', 'application/json');
 
         $I->sendPOST('/api/recuperar_clave', $body);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         $I->assertTrue($response->status == 'exito');*/
 
     }

     public function recuperar_clave_link(ApiTester $I)
     {
        //recuperar clave link
       /*  $body = [
            'email' => 'user0@laplanamartinez.com',
        ];
 
        $I->haveHttpHeader('Content-Type', 'application/json');
 
         $I->sendPOST('/api/recuperar_clave_link', $body);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         $I->assertTrue($response->status == 'exito');
            */
     }

     // ingresar_con_pin
    public function ingresar_con_pin(ApiTester $I)
    {
       //ingresar_con_pin
        $user0 = [
           'email' => 'user0@laplanamartinez.com',
           "pin" => "1234",
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        //Login user0
        $I->sendPOST('/api/ingresar_con_pin', $user0);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function usuarios_edit(ApiTester $I)
    {
       //ingresar_con_pin
       $user0 = [
            'nombre' => 'Ricaldoo',
            'genero' => 'Masculino',
            'ciudad' => 'Caracas',
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');

        //Login user0
        $I->sendPUT('/api/usuarios/' . ($this->token_for_test) , $user0);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string'
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');

    }

    public function aplaudir(ApiTester $I)
    {
       //aplaudir
        /*$body = [
           'idjugador' => 7777777,
           'idpartido' => 7777777,
           'imei' => "1234",
           'token' => ($this->token_for_test),
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/aplaudir', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function encuesta_votar(ApiTester $I)
    {
       //encuesta_votar
       /* $body = [
           'idencuesta' => 7777777,
           'idrespuesta' => 7777777,
           'token' => ($this->token_for_test),
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/encuesta_votar', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function onceideal(ApiTester $I)
    {
       //onceideal
      /* $player1_test = [ 
            'idjugador'=> 77777,
            'x'=> 1,
            'y'=> 1,
       ];
       $array_players = array($player1_test);
       
        $body = [
            'jugadores' => $array_players,
           'token' => ($this->token_for_test),
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/onceideal', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_post(ApiTester $I)
    {
       //muro_post
       /*
        $body = [
           'mensaje' => "Esto es una prueba automatizada :D!!",
           'token' => ($this->token_for_test),
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/muro', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function muro_comentar(ApiTester $I)
    {
       //muro_comentar
       /*
        $body = [
           'idpost' => 777777,           
           'token' => ($this->token_for_test),
           'comentario' => "Esto es una prueba automatizada :D!!",
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/muro_comentar', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_edit_coment(ApiTester $I)
    {
       //muro_edit_coment
       
        /*$body = [
           'comentario' => "Esto es una prueba automatizada :D!!",
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/muro_edit_coment/77777/777777/'.($this->token_for_test), $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_delete_coment(ApiTester $I)
    {
       //muro_delete_coment
       
       /* $body = [
           'comentario' => "Esto es una prueba automatizada :D!!",
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendDELETE('/api/muro_comentar/77777/777777/'.($this->token_for_test), $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_aplaudir(ApiTester $I)
    {
       //muro_aplaudir
       
       /* $body = [
            'idpost' => 7777777,
            'token' => ($this->token_for_test)
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/muro_aplaudir/', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_comentario_aplaudir(ApiTester $I)
    {
       //muro_comentario_aplaudir
       
      /*  $body = [
            'idcomentario' => 7777777,
            'token' => ($this->token_for_test)
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/muro_comentario_aplaudir/', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_editar(ApiTester $I)
    {
       //muro_editar
       
        /*$body = [
            'mensaje' => 'Ahora es otra prueba pero de edición :D',
            'token' => ($this->token_for_test)
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPUT('/api/muro/777777', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function muro_delete(ApiTester $I)
    {
       //muro_delete
       /*
       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendDELETE('/api/muro/777777/' . ($this->token_for_test));
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');*/
    }

    public function suscripciones_cancelar(ApiTester $I)
    {
       //suscripciones_cancelar
       $body = [
           'token' => $this->token_for_test,
           'razon' => "Ay no me gustó...",
       ];
       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/suscripciones/cancelar/', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

}
