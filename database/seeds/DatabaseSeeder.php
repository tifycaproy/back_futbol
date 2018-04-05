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
    }
}
