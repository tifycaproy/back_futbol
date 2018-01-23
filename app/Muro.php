<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muro extends Model
{
    protected $table = 'muro';
	protected $guarded = ['id'];

//relaciones
    public function comentarios()
    {
        return $this->hasMany('App\MuroComentario','muro_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario','usuario_id');
    }

    public function aplausos()
    {
        return $this->hasMany('App\MuroAplauso','muro_id');
    }
}
