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
        return $this->belongsToMany('App\Noticia', 'noticias_jugadores', 'jugadores_id', 'noticias_id')->select('noticias.id','link','titulo','descripcion','fecha','foto','destacada','tipo','dorado')->orderby('fecha','desc','noticias.id');
    }
    public function convocado()
    {
        return $this->hasOne('App\Convocado');
    }


    public function fecha()
    {
        return $this->belongsTo('App\Calendario','calendario_id');
    }

    public function aplausos_up($idcalendario)
    {
        return $this->hasMany('App\Aplauso','jugadores_id')->where('aplausos.calendario_id',$idcalendario);
    }
    public function aplausos()
    {
        return $this->hasMany('App\Aplauso','jugadores_id');
    }


}
