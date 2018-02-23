<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
	protected $guarded = ['id'];
    public $timestamps = false;

//relaciones
    public function partido()
    {
        return $this->belongsTo('App\Calendario','calendario_convodados_id');
    }
    public function partido_alineacion()
    {
        return $this->belongsTo('App\Calendario','calendario_alineacion_id');
    }
}
