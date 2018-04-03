<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    protected $table = 'posicions';
    protected $guarded = ['id'];

    //relaciones

    public function equipo()
    {
        return $this->belongsTo('App\Equipo', 'equipo_id');
    }
}
