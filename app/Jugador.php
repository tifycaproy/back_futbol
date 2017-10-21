<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
	protected $guarded = ['id'];

//relaciones
    public function noticias()
    {
        return $this->belongsToMany('App\Noticia', 'noticias_jugadores', 'jugadores_id', 'noticias_id')->select('noticias.id','link','titulo','descripcion','fecha','foto','destacada','tipo');
    }
    public function convocado()
    {
    	return $this->hasOne('App\Convocado');
    }
}
