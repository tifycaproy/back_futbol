<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';
	protected $guarded = ['id'];

//relaciones
    public function respuestas()
    {
        return $this->hasMany('App\EncuestaRespuesta');
    }
}
