<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MuroReporte extends Model
{
	use SoftDeletes;
    protected $table = 'muro_reporte';
	protected $guarded = ['id'];
	protected $fillable = [ 'descripcion', 'tipo', 'usuario_id', 'muro_id'];

	function usuario(){
		return $this->belongsTo('App\Usuario','usuario_id');
	}

	function post(){
		return $this->belongsTo('App\Muro','muro_id');
	}

}
