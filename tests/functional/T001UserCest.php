<?php

class UserCest
{

    public function userRegister(FunctionalTester $I)
    {
        $body = [
            "nombre" => "Ricardo Pereira",
            "email" => "ricky@laplanamartinez.com",
            "clave" => "123456",
        ];

        $user0 = [
            'email' => 'user0@laplanamartinez.com',
            'nombre' => 'user0',
            "clave" => "123456",
        ];

        $user1 = [
            'email' => 'user1@laplanamartinez.com',
            'nombre' => 'user1',
            "clave" => "123456",
        ];

        $user2 = [
            'email' => 'user2@laplanamartinez.com',
            'nombre' => 'user2',
            "clave" => "123456",
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/usuarios', $body);

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
    }


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

    public function consultarUsuarios(FunctionalTester $I)
    {

        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get user0
        $I->sendGET('/api/usuarios/' . FunctionalTester::$token0);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue($response->data->nombre == 'user0');

        //Get user1
        $I->sendGET('/api/usuarios/' . FunctionalTester::$token1);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue($response->data->nombre == 'user1');

        //Get user2
        $I->sendGET('/api/usuarios/' . FunctionalTester::$token2);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue($response->data->nombre == 'user2');
    }
}