<?php


class NoticiasCest
{
    
    public function noticias(FunctionalTester $I)
    {
        # code...	/noticias
        $I->haveHttpHeader('Content-Type', 'application/json');
        //Get noticias
        $I->sendGET('/api/noticias/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function noticia_fotos(ApiTester $I)
    {
        # code...	/noticia_fotos
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get noticia_fotos
        $I->sendGET('/api/noticia_fotos/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }
    

    public function noticias_futbolbase(ApiTester $I)
    {
        # code...	/noticias_futbolbase
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get noticias_futbolbase
        $I->sendGET('/api/noticias_futbolbase?page=1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }
}
