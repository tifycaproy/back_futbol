<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendariofb extends Model
{
    protected $table = 'calendariofb';
	protected $guarded = ['id'];

//relaciones
    public function copa()
    {
        return $this->belongsTo('App\Copafb');
    }
    public function equipo1()
    {
        return $this->belongsTo('App\Equipo', 'equipo_1');
    }
    public function equipo2()
    {
        return $this->belongsTo('App\Equipo', 'equipo_2');
    }
    public function noticias()
    {
        return $this->hasMany('App\Noticia','id_calendario_noticiafb')->select('id','link','titulo','descripcion','fecha','foto','destacada','tipo');
    }
}
