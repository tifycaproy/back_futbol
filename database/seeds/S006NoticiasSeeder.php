<?php
use App\Noticia;
use App\NoticiaFoto;
use Illuminate\Database\Seeder;

class S006NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $noticia1= [
            'titulo' => "Noticia_Titulo",
            'link' => "",
            'descripcion' => "Una noticia para una prueba automatizada, que tal?",
            'fecha' => "2018-05-28",
            'active' => '1',
            'foto' => "",
            'aparecetimelineppal' => "1",
            'destacada' => "0",
            'tipo' => "Normal",
            'aparevetimelinemonumentales' => "1",
            'aparecefutbolbase' => "0",
            'id_calendario_noticia' => "0",
            'id_calendario_noticiafb' => "0",
            'id_respuesta_noticia' => "0",
            'dorado' => "0" 
        ];

        $noticia2= [
            'titulo' => "Otra noticia",
            'link' => "",
            'descripcion' => "¿Qué hay de nuevo amigos?",
            'fecha' => "2018-05-30",
            'active' => '1',
            'foto' => "",
            'aparecetimelineppal' => "1",
            'destacada' => "0",
            'tipo' => "Normal",
            'aparevetimelinemonumentales' => "0",
            'aparecefutbolbase' => "1",
            'id_calendario_noticia' => "0",
            'id_calendario_noticiafb' => "0",
            'id_respuesta_noticia' => "0",
            'dorado' => "0" 
        ];

        Noticia::create($noticia1);
        Noticia::create($noticia2);

        $noticia_fotos1 = [
            'noticia_id' => 1,
            'titulo' => "Una noticia con una foto",
            'foto' => ""
        ];

        $noticia_fotos2 = [
            'noticia_id' => 2,
            'titulo' => "Otra noticia igual pero distinta",
            'foto' => ""
        ];

        NoticiaFoto::create($noticia_fotos1);
        NoticiaFoto::create($noticia_fotos2);
    }
}
