<?php

namespace App\Http\Middleware;

use App\Exceptions\UserDoradoException;
use App\Usuario;
use App\SeccionesDoradas;
use App\FuncionesDoradas;
use App\Muro;
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
        if($request["tipo_post"] != 'video' || !isset($request["tipo_post"])) {

            $request1=json_decode($request->getContent());
            $request1=get_object_vars($request1);
            
            if(!isset($request1["token"])) {
                return $next($request);
            }
        }else{
            $request1["token"] = $request["token"];
        }

        $token = $request["token"];
        $token = decodifica_token($token);

        $usuario = Usuario::where('id',$token)->first();
        if($tipo == 'seccion')
        {
            $seccion = SeccionesDoradas::where('nombre',$nombre)->first();
            if($seccion->solo_dorado && !$usuario->dorado)
                 return response()->json(['status' => 'no_dorado','error'=>["Debe ser hincha dorado para realizar esta acción"]]);
        }
        else if($tipo == 'funcion')
        {

            $funcion = FuncionesDoradas::where('nombre',$nombre)->first();
            $posts=Muro::where('usuario_id', $token)->count();

            if($funcion->solo_dorado && $usuario->dorado && $posts >= $funcion->max_dorado)
                return response()->json(['status' => 'limite_post','error'=>["Disculpe, Ha llegado al limite de post"]]);

            if($funcion->solo_dorado && !$usuario->dorado && $posts >= $funcion->max_normal)
                return response()->json(['status' => 'limite_post','error'=>["Disculpe, Ha llegado al limite de post"]]);

            if($funcion->solo_dorado && !$usuario->dorado)
                 return response()->json(['status' => 'no_dorado','error'=>["Debe ser hincha dorado para realizar esta acción"]]);


        }
        
        return $next($request);
    }

}
