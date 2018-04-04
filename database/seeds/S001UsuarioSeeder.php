<?php

use App\Usuario;
use Illuminate\Database\Seeder;

class S001UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user0 = [
            'email' => 'user0@laplanamartinez.com',
            'nombre' => 'user0',
            'clave' => bcrypt('user0'),
            'estatus' => 'ACTIVO'
        ];

        $user1 = [
            'email' => 'user1@laplanamartinez.com',
            'nombre' => 'user1',
            'clave' => bcrypt('user1'),
            'estatus' => 'ACTIVO'
        ];

        $user2 = [
            'email' => 'user2@laplanamartinez.com',
            'nombre' => 'user2',
            'clave' => bcrypt('user2'),
            'estatus' => 'ACTIVO'
        ];

        Usuario::create($user0);
        Usuario::create($user1);
        Usuario::create($user2);
    }
}
