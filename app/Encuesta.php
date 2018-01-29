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
    /*
    public function respuestas($idusuario)
    {
        return $this->hasMany('App\EncuestaRespuesta');
    }
    */
}
