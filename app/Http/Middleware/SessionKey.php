<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class SessionKey
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $request->session()->has('cartId')) {
            $request->session()->put('cartId', md5(Request::ip()));
        }
        return $next($request);
    }
}
