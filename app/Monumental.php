<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monumental extends Model
{
    protected $table = 'monumentales';
	protected $guarded = ['id'];

//relaciones
	public function votos()
    {
    	return $this->hasMany('App\MonumentalVotos');
    }
}
