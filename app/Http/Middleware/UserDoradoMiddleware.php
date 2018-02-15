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

        dd(['token' => $request->route('token'),
            'tipo' => $tipo,
            'nombre' => $nombre]);


        return $next($request);
    }
}
