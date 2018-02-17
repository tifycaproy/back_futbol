<?php

namespace App\Http\Middleware;

use App\Exceptions\UserDoradoException;
use App\Usuario;
use App\SeccionesDoradas;
use App\FuncionesDoradas;
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
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);

        $token = $request["token"];

        $usuario = Usuario::find($token);

        if($tipo == 'seccion')
        {
            $seccion = SeccionesDoradas::where('nombre',$nombre);
            if($seccion->solo_dorado && !$usuario->dorado)
                throw new UserDoradoException();
        }
        else if($tipo == 'funcion')
        {
            $funcion = FuncionesDoradas::where('nombre',$nombre);
            if($funcion->solo_dorado && !$usuario->dorado)
                throw new UserDoradoException();
        }
        return $next($request);
    }
}
