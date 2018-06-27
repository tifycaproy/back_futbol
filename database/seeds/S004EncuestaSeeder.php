<?php
use App\Encuesta;
use Illuminate\Database\Seeder;

class S004EncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $encuesta1= [
            'titulo' => "Encuesta Simple",
            'fecha_inicio' => "2018-05-28",
            'fecha_fin' => "2020-12-30",
            'tipo_voto' => "Único",
            'mostrar_resultados' => "Siempre",
            'activa' => '0'
        ];

        $encuesta2= [
            'titulo' => "Encuesta Multiple",
            'fecha_inicio' => "2018-05-28",
            'fecha_fin' => "2020-12-30",
            'tipo_voto' => "Múltiple simple",
            'mostrar_resultados' => "Siempre",
            'activa' => '1'
        ];

        Encuesta::create($encuesta1);
        Encuesta::create($encuesta2);
    }
}
