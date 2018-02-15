<?php

use App\SeccionesDoradas;
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
            'noticias',
            'muro',
            'chat',
            'calendario',
            'tu_escoges',
            'tabla',
            'alineacion',
            'equipo',
            'estadisticas',
            'realidad_virtual',
            'futbol_base',
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
    }
}
