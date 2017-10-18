<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
	protected $guarded = ['id'];

//relaciones
    public function partido()
    {
        return $this->belongsTo('App\Calendario','calendario_convodados_id');
    }
}
