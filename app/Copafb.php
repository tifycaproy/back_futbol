<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Copafb extends Model
{
    protected $table = 'copasfb';
	protected $guarded = ['id'];

//relaciones
	public function fechas_calendario()
    {
        return $this->hasMany('App\Calendariofb','copas_id')->orderby('fecha','desc');
    }
	public function fechas_partidos()
    {
        return $this->hasMany('App\Calendariofb','copas_id')->where(function($q){
        	$q->where("equipo_1",1)->orwhere('equipo_2',1);
        })->orderby('fecha','desc');
    }
}

