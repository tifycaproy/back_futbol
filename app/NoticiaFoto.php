<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticiaFoto extends Model
{
    protected $table = 'noticias_fotos';
	protected $guarded = ['id'];
}
