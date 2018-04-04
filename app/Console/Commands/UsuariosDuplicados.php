<?php

namespace App\Console\Commands;

use App\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UsuariosDuplicados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '2way:checkDuplicateUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chequeo de Usuarios duplicados por email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = Usuario::select(DB::raw('count(*) as count, email'))->groupBy('email')->havingRaw('count(*) > 1')->get();
        foreach ($users as $user) {
            $this->info($user);
        }
        if (sizeof($users) == 0) {
            $this->info('No se encontraron emails duplicado!');
        }
    }
}
