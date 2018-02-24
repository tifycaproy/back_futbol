<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIdSuscripcionesColumnUsuariosSuscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
    	Schema::table('usuarios_suscripciones', function($table)
    	{
    		$table->renameColumn('id_tipo_membresia', 'id_usuario_suscripciones');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	
    }
}






