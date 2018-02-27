<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AplausoCalendario extends Model
{
    protected $table = 'aplausos_calendario';
	protected $guarded = ['id'];

//relaciones
	public function fecha()
    {
        return $this->belongsTo('App\Calendario','calendario_id');
    }
}
