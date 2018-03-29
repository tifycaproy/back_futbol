<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThumbnaiPost extends Migration
{

    public function up()
    {
        Schema::table('muro', function (Blueprint $table) {
            $table->text('thumbnail')->nullable();
        }); 
    }

    public function down()
    {
        
    }
}
