<?php

use App\Muro;
use App\MuroComentario;
use App\Usuario;
use Illuminate\Database\Seeder;

class S002MuroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = Usuario::all();

        foreach ($users as $user) {
            Muro::create([
                'usuario_id' => $user->id,
                'mensaje' => 'Test post del usuario: ' . $user->email,
                'tipo_post' => 'Tipo1',
            ]);
        }

        $muros = Muro::all();

        foreach ($muros as $muro) {
            foreach ($users as $user) {
                $comentario = [
                    'muro_id' => $muro->id,
                    'usuario_id' => $user->id,
                    'comentario' => 'Test comentario del usuario: ' . $user->email,
                ];
                if ($muro->usuario_id != $user->id) {
                    MuroComentario::create($comentario);
                }
            }
        }
    }
}
