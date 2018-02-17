<?php

namespace App\Http\Middleware;

use App\Exceptions\UserDoradoException;
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
        dd(['token' => $request->route('token'),
            'tipo' => $tipo,
            'nombre' => $nombre]);

        $token = $request->route('token');

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
