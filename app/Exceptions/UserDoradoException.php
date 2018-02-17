<?php

namespace App\Exceptions;

use Exception;

class UserDoradoException extends Exception
{
	public function render($request, Exception $exception)
	{

		if ($exception instanceof UserDoradoException) {
			return response()->json(['status' => 'fallo','error'=>["Debe ser hincha dorado para realizar esta acción"]]);
		}
		
		return parent::render($request, $exception);
	}

}
