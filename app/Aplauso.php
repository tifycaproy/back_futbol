<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplauso extends Model
{
    protected $table = 'aplausos';
	protected $guarded = ['id'];

//relaciones
	public function fotos()
    {
        return $this->hasMany('App\NoticiaFoto');
    }
}
