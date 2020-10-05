<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $header = $request->header('Authorization');

        if (!$request->headers->has('token')) {
            return response(['error'=>"request needs a token"]);
        }
        return $next($request);
    }
}
