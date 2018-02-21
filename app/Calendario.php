<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendario';
	protected $guarded = ['id'];

//relaciones
    public function copa()
    {
        return $this->belongsTo('App\Copa','copas_id');
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
        return $this->hasMany('App\Noticia','id_calendario_noticia')->select('id','link','titulo','descripcion','fecha','foto','destacada','tipo');
    }
    public function formacion(){
        return $this->belongsTo('App\Formacion');
    }
    public function titulares()
    {
        return $this->hasMany('App\Alineacion')->where('estado','Titular');
    }
    public function suplentes()
    {
        return $this->hasMany('App\Alineacion')->where('estado','Suplente');
    }
}
