<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugadorfb extends Model
{
    protected $table = 'jugadoresfb';
	protected $guarded = ['id'];

//relaciones
    public function noticias()
    {
        return $this->belongsToMany('App\Noticia', 'noticias_jugadoresfb', 'jugadoresfb_id', 'noticias_id')->select('noticias.id','link','titulo','descripcion','fecha','foto','destacada','tipo');
    }
}
