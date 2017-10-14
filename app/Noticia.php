<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
	protected $guarded = ['id'];

//relaciones
	public function fotos()
    {
        return $this->hasMany('App\NoticiaFoto');
    }
}
