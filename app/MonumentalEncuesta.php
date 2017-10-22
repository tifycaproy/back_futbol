<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonumentalEncuesta extends Model
{
    protected $table = 'monumental_encuesta';
	protected $guarded = ['id'];

//relaciones
	public function monumentales()
    {
    	return $this->belongsToMany('App\Monumental');
    }
    public function votos()
    {
        return $this->hasMany('App\MonumentalVotos');
    }
    public function seleccionadas()
    {
        return $this->hasMany('App\MonumentalEncuestaMonumental');
    }
}
