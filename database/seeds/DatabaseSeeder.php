<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(S001UsuarioSeeder::class);
        $this->call(S002MuroSeeder::class);
        $this->call(S003DoradoSeeder::class);
// auto-testing
        $this->call(S004EncuestaSeeder::class);
        $this->call(S005EncuestaRespuestasSeeder::class);
        $this->call(S006NoticiasSeeder::class);
// Ricargo Merge

    }
}
