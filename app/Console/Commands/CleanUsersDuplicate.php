<?php

namespace App\Console\Commands;

use App\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanUsersDuplicate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '2way:cleanDuplicateUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpieza de Usuarios duplicados por email';

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
        $ids = array();
        $this->info('Loading!');
        $this->bar = $this->output->createProgressBar(sizeof($users));
        $this->bar->display();
        foreach ($users as $user) {

            $usuario = Usuario::select('id', 'nombre', 'email', 'ultimo_ingreso')->where('email', $user->email)->orderBy('ultimo_ingreso', 'DESC')->get();
            
            foreach ($usuario as $index => $u) {
               // $this->info($u . (($index == 0) ? '' : ' -> <fg=red>registro duplicado preparado para borrar!</>'));
                if ($index > 0) {
                    array_push($ids, $u);
                }
            }

            $this->bar->advance();
        }

        if (sizeof($ids) == 0) {
            $this->info('No se encontraron emails duplicado!');
        } else {
            $this->info(PHP_EOL.'Se encontraron ' . sizeof($ids) . ' email duplicados!');
            $borrar = $this->confirm(
                'Desea borrar los usarios duplicados ?'
            );

            if ($borrar) {

                $borrar = $this->confirm(
                    'Se eliminaran ' . sizeof($ids) . ' registros, esta seguro de esta accion?'
                );

                if ($borrar) {
                    $this->bar = $this->output->createProgressBar(sizeof($ids));
                    $this->bar->display();
                    foreach ($ids as $u) {
                        $u->delete();
                        $this->bar->advance();
                    }
                    $this->info(PHP_EOL . sizeof($ids) . ' Usuarios eliminados');
                } else {
                    $this->info('No se ejecuto ninguna accion!');
                }
            } else {
                $this->info('No se ejecuto ninguna accion!');
            }
        }
    }
}
