<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PuntoReferencia extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'punto_referencia';
    protected $fillable = [ 'cordx', 'cordy', 'descripcion', 'nombre'];

    function imagenes(){
		return $this->hasMany('App\PuntoReferenciaImagen');
	}
}
