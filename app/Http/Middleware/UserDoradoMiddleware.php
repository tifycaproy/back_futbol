<?php

namespace App\Http\Middleware;

use App\Exceptions\UserDoradoExcetion;
use App\Usuario;
use App\SeccionesDoradas;
use Closure;

class UserDoradoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo, $nombre)
    {  
        //Buscar id de usuario segun el token -- TODO -> no logro sacar el token de la ruta
        $idusuario = decodifica($request->route('token'));

        $usuario = Usuario::find($idusuario);
        //Buscar info de la seccion segun el nombre
        if($tipo == 'seccion'){
                $seccion_dorada = SeccionesDorada::where('nombre',$nombre);
                //$request->route('parameter_name');
        
                if(!$usuario->dorado && $seccion_dorada->solo_dorado);
                throw new UserDoradoExcetion();
        }
        else
        return $next($request);
    }
}
