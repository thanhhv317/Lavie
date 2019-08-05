<?php

namespace App\Http\Middleware;

use Closure;

class LevelUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->level == 1)
        {
            // Admin
            return $next($request);
        }
        if ($request->user() && $request->user()->level == 2)
        {
            //supper admin
            return ;
        }
        return redirect('/');
    }
}
