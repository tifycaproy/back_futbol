<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Usuario extends Model
{
	use SyncsWithFirebase;
	
    protected $table = 'usuarios';
	protected $guarded = ['id'];

//relaciones
	public function post()
    {
        return $this->hasMany('App\Muro','usuario_id');
    }
}
