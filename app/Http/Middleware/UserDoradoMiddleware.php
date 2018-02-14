<?php

namespace App\Http\Middleware;

use App\Exceptions\UserDoradoExcetion;
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
    public function handle($request, Closure $next)
    {
        //$request->route('parameter_name');

        throw new UserDoradoExcetion();

        // get-user

        /*
         * if(!user.isDorado()
         *  throw new UserDoradoExcetion();
         *
         * */


        return $next($request);
    }
}
