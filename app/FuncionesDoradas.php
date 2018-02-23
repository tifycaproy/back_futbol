<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncionesDoradas extends Model
{
    protected $table = 'funciones_doradas';

    protected $fillable = [
        'id', 'nombre', 'solo_dorado', 'max_dorado', 'max_normal'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
