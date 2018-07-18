<?php


class GetsCest
{
   
    // tests
    public function config(ApiTester $I)
    {
        /*$I->haveHttpHeader('Content-Type', 'application/json');

        //Get config
        $I->sendGET('/api/configuracion/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function banners(ApiTester $I)
    {
        # code...	/banners
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get banners
        $I->sendGET('/api/banners/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function ventanas_compartir(ApiTester $I)
    {
        # code...	/ventanas_compartir
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get ventanas_compartir
        $I->sendGET('/api/ventanas_compartir/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function noticias(ApiTester $I)
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
        $I->sendGET('/api/noticias_futbolbase?page=1154548878484');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function reenviar_pin_confirmacion(ApiTester $I)
    {
        # code...	/reenviar_pin_confirmacion
        /*$I->haveHttpHeader('Content-Type', 'application/json');

        //Get reenviar_pin_confirmacion
        $I->sendGET('/api/reenviar_pin_confirmacion/user0@laplanamartinez.com/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function usuario_consulta(ApiTester $I)
    {
        # code...	/usuario_consulta
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get usuario_consulta
        $I->sendGET('/api/usuarios/' . "1234");
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function referidos(ApiTester $I)
    {
        # code...	/noticias_futbolbase
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get noticias_futbolbase
        $I->sendGET('/api/consultar_referidos/' . "1234?page=1154548878484");
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function copas(ApiTester $I)
    {
        # code...	/copas
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get copas
        $I->sendGET('/api/copas/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }
    
    public function partidos(ApiTester $I)
    {
        # code...	/partidos
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get partidos
        $I->sendGET('/api/partidos/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }
    
    public function posicion(ApiTester $I)
    {
        # code...	/posicion
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get posicion
        $I->sendGET('/api/posicion/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function calendario(ApiTester $I)
    {
        # code...	/calendario
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get calendario
        $I->sendGET('/api/calendario/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function single_calendario(ApiTester $I)
    {
        # code...	/single_calendario
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get single_calendario
        $I->sendGET('/api/single_calendario/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function calendariofb(ApiTester $I)
    {
        # code...	/calendariofb
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get calendariofb
        $I->sendGET('/api/calendariofb/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function single_calendariofb(ApiTester $I)
    {
        # code...	/single_calendariofb
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get single_calendariofb
        $I->sendGET('/api/single_calendariofb/1154548878484');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function convocados(ApiTester $I)
    {
        # code...	/convocados
       /* $I->haveHttpHeader('Content-Type', 'application/json');

        //Get convocados
        $I->sendGET('/api/convocados/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function playbyplay(ApiTester $I)
    {
       /* # code...	/playbyplay
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get playbyplay
        $I->sendGET('/api/playbyplay/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function nomina(ApiTester $I)
    {
        # code...	/nomina
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get nomina
        $I->sendGET('/api/nomina/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function nominafb(ApiTester $I)
    {
        # code...	/nominafb
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get nominafb
        $I->sendGET('/api/nominafb/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function single_jugador(ApiTester $I)
    {
        # code...	/single_jugador
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get single_jugador
        $I->sendGET('/api/single_jugador/1154548878484/123');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function single_jugadorfb(ApiTester $I)
    {
        # code...	/single_jugadorfb
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get single_jugadorfb
        $I->sendGET('/api/single_jugadorfb/1154548878484/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function aplausos_equipo(ApiTester $I)
    {
        # code...	/aplausos_equipo
        /*$I->haveHttpHeader('Content-Type', 'application/json');

        //Get aplausos_equipo
        $I->sendGET('/api/aplausos_equipo/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function encuesta(ApiTester $I)
    {
        # code...	/encuesta
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get encuesta
        $I->sendGET('/api/encuesta/1234');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function single_respuesta(ApiTester $I)
    {
        # code...	/single_respuesta
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get single_respuesta
        $I->sendGET('/api/single_respuesta/777777');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function ranking_encuestas(ApiTester $I)
    {
        # code...	/ranking_encuestas
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get ranking_encuestas
        $I->sendGET('/api/ranking_encuestas/2');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'respuestas' => array()
        ]);
        $response = json_decode($I->grabResponse());
    }

    public function onceideal_consulta(ApiTester $I)
    {
        # code...	/onceideal_consulta
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get onceideal_consulta
        $I->sendGET('/api/onceideal/777777');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function videos_vr(ApiTester $I)
    {
        # code...	/videos_vr
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get videos_vr
        $I->sendGET('/api/videos360/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

   
    public function muro(ApiTester $I)
    {
        # code...	/videos_vr
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get videos_vr
        $I->sendGET('/api/muro?page=777777777');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function perfil_usuario(ApiTester $I)
    {
        # code...	/perfil_usuario
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get perfil_usuario
        $I->sendGET('/api/perfil_usuario/777777777');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function comentarios_post(ApiTester $I)
    {
        # code...	/comentarios_post
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get comentarios_post
        $I->sendGET('/api/comentarios_post/777777777?token=1234&page=777777');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'fallo');
    }

    public function dorado_config(ApiTester $I)
    {
        # code...	/dorado_config
        /*$I->haveHttpHeader('Content-Type', 'application/json');

        //Get dorado_config
        $I->sendGET('/api/dorado/config/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');*/
    }

    public function suscripciones_tipos(ApiTester $I)
    {
        # code...	/suscripciones_tipos
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get suscripciones_tipos
        $I->sendGET('/api/suscripciones/tipos/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function suscripciones_razones(ApiTester $I)
    {
        # code...	/suscripciones_razones
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get suscripciones_razones
        $I->sendGET('/api/suscripciones/razonescancelarsuscripcion/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function suscripciones_beneficios(ApiTester $I)
    {
        # code...	/suscripciones_beneficios
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get suscripciones_beneficios
        $I->sendGET('/api/suscripciones/beneficios/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'data' => array()
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }

    public function punto_referencia(ApiTester $I)
    {
        # code...	/punto_referencia
        $I->haveHttpHeader('Content-Type', 'application/json');

        //Get punto_referencia
        $I->sendGET('/api/punto_referencia/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType([
            'status' => 'string'
        ]);
        $response = json_decode($I->grabResponse());
        $I->assertTrue($response->status == 'exito');
    }


}
