<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelarSuscripcion extends Model
{
    protected $table = 'cancelar_suscripcions';

    protected $fillable = [
        'id', 'descripcion',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
