<?php


class EncuestaCest
{
   /* public function userRegister(FunctionalTester $I)
    {
        $user0 = [
            'email' => 'user0@laplanamartinez.com',
            'nombre' => 'user0',
            "clave" => "123456",
            'estatus' => 'ACTIVO'
        ];

        $user1 = [
            'email' => 'user1@laplanamartinez.com',
            'nombre' => 'user1',
            "clave" => "123456",
            'estatus' => 'ACTIVO'
        ];

        $user2 = [
            'email' => 'user2@laplanamartinez.com',
            'nombre' => 'user2',
            "clave" => "123456",
            'estatus' => 'ACTIVO'
        ];


        $I->sendPOST('/api/usuarios', $user0);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $I->assertTrue($response->status == 'fallo');

        $I->sendPOST('/api/usuarios', $user1);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $I->assertTrue($response->status == 'fallo');

        $I->sendPOST('/api/usuarios', $user2);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $I->assertTrue($response->status == 'fallo');
    }*/


    public function userLogin(FunctionalTester $I)
    {
        $user0 = [
            'email' => 'user0@laplanamartinez.com',
            "clave" => "user0",
        ];

        $user1 = [
            'email' => 'user1@laplanamartinez.com',
            "clave" => "user1",
        ];

        $user2 = [
            'email' => 'user2@laplanamartinez.com',
            "clave" => "user2",
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
        FunctionalTester::$token0 = $response->data->token;

        //Login user1
        $I->sendPOST('/api/auth', $user1);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        FunctionalTester::$token1 = $response->data->token;

        //Login user2
        $I->sendPOST('/api/auth', $user2);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        FunctionalTester::$token2 = $response->data->token;
    }

    public function encuesta_votar(FunctionalTester $I)
    {
       //encuesta_votar
       //Voto 1
        $body = [
           'idencuesta' => "2",
           'idrespuesta' => "4",
           'token' =>FunctionalTester::$token0,
       ];

       $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/api/encuesta_votar', $body);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');

        //Voto 2
        $body = [
            'idencuesta' => "2",
            'idrespuesta' => "5",
            'token' =>FunctionalTester::$token0,
        ];
 
        $I->haveHttpHeader('Content-Type', 'application/json');
 
         $I->sendPOST('/api/encuesta_votar', $body);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         $I->assertTrue($response->status == 'exito');

         //Voto 3

         $body = [
            'idencuesta' => "2",
            'idrespuesta' => "6",
            'token' =>FunctionalTester::$token0,
        ];
 
        $I->haveHttpHeader('Content-Type', 'application/json');
 
         $I->sendPOST('/api/encuesta_votar', $body);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         $I->assertTrue($response->status == 'exito');

         //Revisemos los votos
         $I->haveHttpHeader('Content-Type', 'application/json'); 
         $I->sendGET('/api/encuesta/' . FunctionalTester::$token0);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         foreach($response->data->respuestas as $respuestas){
                $I->assertTrue($respuestas->yavoto == '1');            
         }
         $I->assertTrue($response->status == 'exito');
    }   
}
