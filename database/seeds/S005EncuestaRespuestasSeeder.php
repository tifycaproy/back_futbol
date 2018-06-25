<?php
use App\EncuestaRespuesta;
use Illuminate\Database\Seeder;

class S005EncuestaRespuestasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $encuesta_respuesta1= [
            'encuesta_id' => "1",
            'respuesta' => "Respuesta 1",
            'votos' => 0,
            'foto' => "",
            'banner' => "",
            'miniatura' => ""
        ];

        $encuesta_respuesta2= [
            'encuesta_id' => "1",
            'respuesta' => "Respuesta 2",
            'votos' => 0,
            'foto' => "",
            'banner' => "",
            'miniatura' => ""
        ];

        $encuesta_respuesta3= [
            'encuesta_id' => "1",
            'respuesta' => "Respuesta 3",
            'votos' => 0,
            'foto' => "",
            'banner' => "",
            'miniatura' => ""
        ];

        $encuesta_respuesta4= [
            'encuesta_id' => "2",
            'respuesta' => "Respuesta 1",
            'votos' => 0,
            'foto' => "",
            'banner' => "",
            'miniatura' => ""
        ];

        $encuesta_respuesta5= [
            'encuesta_id' => "2",
            'respuesta' => "Respuesta 2",
            'votos' => 0,
            'foto' => "",
            'banner' => "",
            'miniatura' => ""
        ];

        $encuesta_respuesta6= [
            'encuesta_id' => "2",
            'respuesta' => "Respuesta 3",
            'votos' => 0,
            'foto' => "",
            'banner' => "",
            'miniatura' => ""
        ];

        EncuestaRespuesta::create($encuesta_respuesta1);
        EncuestaRespuesta::create($encuesta_respuesta2);
        EncuestaRespuesta::create($encuesta_respuesta3);
        EncuestaRespuesta::create($encuesta_respuesta4);
        EncuestaRespuesta::create($encuesta_respuesta5);
        EncuestaRespuesta::create($encuesta_respuesta6);
    }
}
