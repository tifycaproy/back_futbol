<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCiudadPais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('punto_referencia', function (Blueprint $table) {
            $table->text('pais')->nullable();
            $table->text('ciudad')->nullable();
        }); 
    }


    public function down()
    {
        //
    }
}
