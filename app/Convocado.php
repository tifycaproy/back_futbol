<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convocado extends Model
{
    protected $table = 'convocados';
	protected $guarded = ['id'];

//relaciones
    public function jugador()
    {
        return $this->belongsTo('App\Jugador')->select('id','nombre','banner','foto');
    }
}
