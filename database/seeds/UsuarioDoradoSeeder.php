<?php

use App\SeccionesDoradas;
use App\FuncionesDoradas;
use Illuminate\Database\Seeder;

class UsuarioDoradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seecciones = [
            'muro',
            'calendario',
            'tu_escoges',
            'tabla',
            'alineacion',
            'equipo',
            'estadisticas',
            'realidad_virtual',
            'futbol_base',
            'academia',
            'tienda_virtual'
        ];

        foreach ($seecciones as $seccion) {
            $seed = new SeccionesDoradas();
            $seed->nombre = $seccion;
            $seed->solo_dorado = false;
            $seed->funciones_doradas = false;
            $seed->mensaje_dorado = 'Mensaje invitando a comprar membresía específico de sección';
            $seed->save();
        }

        $funciones = [
            'muro_postear',
            'muro_comentar',
            'muro_post_aplaudir',
            'muro_comentario_aplaudir',
            'enviar_once_ideal',
            'aplaudir_single_jugador',
            'encuesta_votar'
        ];

        foreach ($funciones as $funcion) {
            $seed = new FuncionesDoradas();
            $seed->nombre = $funcion;
            $seed->solo_dorado = false;
            $seed->max_dorado = 0;
            $seed->max_normal = 0;
            $seed->save();
        }
    }
}
