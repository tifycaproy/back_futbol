<?php

class MuroCest
{
    private static $post1;
    private static $post2;
    private static $post3;

    public function login(FunctionalTester $I){
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

         $I->haveHttpHeader('Content-Type', 'application/json');

         //Login user0
         $I->sendPOST('/api/auth', $user1);
         $I->seeResponseCodeIs(200);
         $I->seeResponseMatchesJsonType([
             'status' => 'string',
             'data' => array()
         ]);
         $response = json_decode($I->grabResponse());
         $I->assertTrue($response->status == 'exito');
         FunctionalTester::$token1 = $response->data->token;

         $I->haveHttpHeader('Content-Type', 'application/json');

         //Login user0
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

    public function indexMuro(FunctionalTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('/api/muro?token=' . FunctionalTester::$token0);
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue(sizeof($response->data) == 3);

        MuroCest::$post1 = $response->data[0];
        MuroCest::$post2 = $response->data[1];
        MuroCest::$post3 = $response->data[2];
    }

    public function muroPerfilDeUsuario(FunctionalTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendGET('/api/perfil_usuario/' . MuroCest::$post1->usuario->codigo);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType(array());
        $I->assertTrue($response->apodo == 'user1');


        $I->sendGET('/api/perfil_usuario/' . MuroCest::$post2->usuario->codigo);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType(array());
        $I->assertTrue($response->apodo == 'user2');


        $I->sendGET('/api/perfil_usuario/' . MuroCest::$post3->usuario->codigo);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType(array());
        $I->assertTrue($response->apodo == 'user0');
    }

    public function comentariosPost(FunctionalTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('/api/comentarios_post/' . MuroCest::$post1->idpost . '?token=' . FunctionalTester::$token0);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue(sizeof($response->data) == 2);

        $I->sendGET('/api/comentarios_post/' . MuroCest::$post2->idpost . '?token=' . FunctionalTester::$token1);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue(sizeof($response->data) == 2);


        $I->sendGET('/api/comentarios_post/' . MuroCest::$post3->idpost . '?token=' . FunctionalTester::$token2);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue(sizeof($response->data) == 2);
    }

    public function muroComentar(FunctionalTester $I)
    {
        //
        $body = [
            "idpost" => MuroCest::$post1->idpost,
            "token" => FunctionalTester::$token0,
            "comentario" => "Test Comentario",
            "foto" => null,
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/muro_comentar', $body);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');

        //
        $body = [
            "idpost" => MuroCest::$post2->idpost,
            "token" => FunctionalTester::$token2,
            "comentario" => "Test Comentario",
            "foto" => null,
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/muro_comentar', $body);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');

        //
        $body = [
            "idpost" => MuroCest::$post3->idpost,
            "token" => FunctionalTester::$token0,
            "comentario" => "Test Comentario",
            "foto" => null,
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/muro_comentar', $body);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
    }

    public function muroAplaudir(FunctionalTester $I)
    {
        //
        $body = [
            "idpost" => MuroCest::$post1->idpost,
            "token" => FunctionalTester::$token1,
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/muro_aplaudir', $body);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');

        //
        $body = [
            "idpost" => MuroCest::$post2->idpost,
            "token" => FunctionalTester::$token2,
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/muro_aplaudir', $body);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');

        //
        $body = [
            "idpost" => MuroCest::$post3->idpost,
            "token" => FunctionalTester::$token0,
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/muro_aplaudir', $body);
        $I->seeResponseCodeIs(200);
        $response = json_decode($I->grabResponse());
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
    }
}