<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Copa extends Model
{
    protected $table = 'copas';
	protected $guarded = ['id'];

//relaciones
	public function fechas_calendario()
    {
        return $this->hasMany('App\Calendario','copas_id')->orderby('fecha','asc');
    }
	public function fechas_partidos()
    {
        return $this->hasMany('App\Calendario','copas_id')->where(function($q){
        	$q->where("equipo_1",1)->orwhere('equipo_2',1);
        })->orderby('fecha','asc');
    }
}

