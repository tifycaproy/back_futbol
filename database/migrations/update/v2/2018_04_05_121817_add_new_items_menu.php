<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewItemsMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->text('tit_17');
            $table->text('tit_17_1');
            $table->text('tit_17_2');
            $table->text('tit_18');
            $table->text('url_tyc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
