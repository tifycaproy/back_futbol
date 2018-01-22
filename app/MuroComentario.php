<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuroComentario extends Model
{
    protected $table = 'muro_comentarios';
	protected $guarded = ['id'];

//relaciones
    public function usuario()
    {
        return $this->belongsTo('App\Usuario','usuario_id');
    }


    public function aplausos()
    {
        return $this->hasMany('App\MuroComentarioAplauso','comentario_id');
    }
}
