<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playbyplay extends Model
{
    protected $table = 'playbyplay';
	protected $guarded = ['id'];

//relaciones
    public function jugador()
    {
        return $this->belongsTo('App\Jugador');
    }
}
