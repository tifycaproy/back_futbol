<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Copas extends Model
{
    protected $table = 'copas';
	protected $guarded = ['id'];

//relaciones
    public function calendario()
    {
        return $this->belongsTo('App\Calendario','id_convocados');
    }
}
