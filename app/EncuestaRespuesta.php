<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaRespuesta extends Model
{
    protected $table = 'encuestas_respuestas';
	protected $guarded = ['id'];

//relaciones
    public function votos()
    {
        return $this->hasMany('App\EncuestaVotos');
    }
    public function noticias()
    {
        return $this->hasMany('App\Noticia','id_respuesta_noticia')->select('id','link','titulo','descripcion','fecha','foto','destacada','tipo')->orderby('fecha','desc','id','desc');
    }
}
