<?php

class MuroCest
{
    private static $post1;
    private static $post2;
    private static $post3;

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
}