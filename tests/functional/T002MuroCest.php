<?php

use App\Muro;

class MuroCest
{
    private static $post1;
    private static $post2;
    private static $post3;

    public function indexMuro(FunctionalTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('/api/muro');
        $response = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $I->assertTrue($response->status == 'exito');
        $I->assertTrue(sizeof($response->data) == 3);

        Muro::$post1 = $response->data[0];
        Muro::$post2 = $response->data[1];
        Muro::$post3 = $response->data[2];

        dd(Muro::$post1);
    }
}