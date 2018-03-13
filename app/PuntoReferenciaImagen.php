<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuntoReferenciaImagen extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'punto_referencia_imagen';
    protected $fillable = [ 'descripcion', 'imagen', 'url', 'punto_referencia_id'];

    function punto_referencia(){
		return $this->belongsTo('App\PuntoReferencia','punto_referencia_id');
	}
}
