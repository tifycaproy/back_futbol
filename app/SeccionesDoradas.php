<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionesDoradas extends Model
{

    protected $table = 'secciones_doradas';

    protected $fillable = [
        'id', 'nombre', 'solo_dorado', 'funciones_doradas', 'mensaje_dorado'
    ];

    protected $hidden = [

    ];
}
