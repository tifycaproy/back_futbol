<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripciones extends Model
{
    protected $table = 'suscripciones';

    protected $fillable = [
        'id', 'descripcion', 'costo_menor', 'costo_mayor', 'duracion'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
