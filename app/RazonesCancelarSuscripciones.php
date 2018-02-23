<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RazonesCancelarSuscripciones extends Model
{
    protected $table = 'razones_cancelar_suscripciones';

    protected $fillable = [
        'id', 'descripcion',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
