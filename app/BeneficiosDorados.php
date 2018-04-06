<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeneficiosDorados extends Model
{
    protected $table = 'beneficios_dorados';

    protected $fillable = [
        'id', 'descripcion', 'url','titulo','link','fecha','active', 'tipo'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
