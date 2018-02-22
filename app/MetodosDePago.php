<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodosDePago extends Model
{
    protected $table = 'metodos_de_pagos';

    protected $fillable = [
        'id', 'descripcion', 'imagen', 'url',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
