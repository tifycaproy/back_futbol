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

    public function jugadores()
    {
        return $this->where('activo',1)->orderby('nombre')->belongsToMany('App\Jugador', 'noticias_jugadores', 'noticias_id','jugadores_id')->select('jugadores.id','nombre','n_camiseta','posicion');
    }
}
