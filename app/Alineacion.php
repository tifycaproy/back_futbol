<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alineacion extends Model
{
    protected $table = 'alineacion';
	protected $guarded = ['id']

//relaciones
    public function jugador()
    {
        return $this->belongsTo('App\Jugador');
    }
}
