<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendario';
	protected $guarded = ['id'];

//relaciones
    public function copa()
    {
        return $this->belongsTo('App\Copa');
    }
    public function equipo1()
    {
        return $this->belongsTo('App\Equipo', 'equipo_1');
    }
    public function equipo2()
    {
        return $this->belongsTo('App\Equipo', 'equipo_2');
    }
}
