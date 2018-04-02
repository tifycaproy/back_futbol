<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatReporte extends Model
{
    use SoftDeletes;
    protected $table = 'chat_reporte';
	protected $guarded = ['id'];
	protected $fillable = [ 'usuario_id', 'usuario_reportado', 'descripcion'];

	function usuario(){
		return $this->belongsTo('App\Usuario','usuario_id');
	}

	function usuario_reportado(){
		return $this->belongsTo('App\Usuario','usuario_reportado');
	}

}
