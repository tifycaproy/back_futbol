<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplauso extends Model
{
    protected $table = 'aplausos';
	protected $guarded = ['id'];

//relaciones
	public function jugador()
    {
        return $this->hasOne('App\Jugador');
    }
}
