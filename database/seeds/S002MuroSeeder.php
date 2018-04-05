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
                'user_id' => $user->id,
                'mensaje' => 'Test post del usuario: ' . $user->email,
            ]);
        }

        $muros = Muro::all();

        foreach ($muros as $muro) {
            foreach ($users as $user) {
                $comentario = array([
                    'muro_id' => $muro->id,
                    'usuario_id' => $user->id,
                    'comentario' => 'Test comentario del usuario: ' . $user->email,
                ]);
                if ($muro->user_id != $user->id)
                    MuroComentario::create($comentario);
            }
        }
    }
}
