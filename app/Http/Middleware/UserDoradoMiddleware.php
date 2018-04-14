<?php

namespace App\Http\Middleware;

use App\FuncionesDoradas;
use App\Muro;
use App\SeccionesDoradas;
use App\Usuario;
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

        $request1 = json_decode($request->getContent());
        $request1 = get_object_vars($request1);

        if (!isset($request1["token"])) {
            return $next($request);
        }

        $token = $request1["token"];
        $token = decodifica_token($token);

        $usuario = Usuario::where('id', $token)->first();

        if ($tipo == 'seccion') {

            $seccion = SeccionesDoradas::where('nombre', $nombre)->first();
            if ($seccion->solo_dorado && !$usuario->dorado)
                return response()->json(['status' => 'no_dorado', 'error' => ["Debe ser hincha dorado para realizar esta acción"]]);
        } else if ($tipo == 'funcion') {
            $funcion = FuncionesDoradas::where('nombre', $nombre)->first();

            if ($funcion->solo_dorado && !$usuario->dorado)
                return response()->json(['status' => 'no_dorado', 'error' => ["Debe ser hincha dorado para realizar esta acción"]]);
            $posts = Muro::where('usuario_id', $token)->where('created_at', '>=', \Carbon\Carbon::now()->subHours(1))->count();


            if ($nombre == 'muro_postear' && $funcion->limitar)
                if ($usuario->dorado) {

                    if ($posts >= $funcion->max_dorado)
                        return response()->json(['status' => 'limite_post', 'error' => ["Has alcanzado el límite de publicaciones de spam acordadas en nuestras políticas"]]);
                } else {

                    if ($posts >= $funcion->max_normal)
                        return response()->json(['status' => 'limite_post', 'error' => ["Has alcanzado el límite de publicaciones de spam acordadas en nuestras políticas"]]);

                }

        }

        return $next($request);
    }

}
