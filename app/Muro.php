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
        return $this->belongsTo('App\Usuario','usuario_id')->select(['id as idusuario','nombre','apellido','email','apodo','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','foto_redes','created_at']);
    }

    public function aplausos()
    {
        return $this->hasMany('App\MuroAplauso','muro_id');
    }
}
