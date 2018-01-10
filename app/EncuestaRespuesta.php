<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaRespuesta extends Model
{
    protected $table = 'encuestas_respuestas';
	protected $guarded = ['id'];

    public function votos()
    {
        return $this->hasMany('App\EncuestaVotos');
    }
}
