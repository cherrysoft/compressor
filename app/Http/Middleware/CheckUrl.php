<?php

namespace Compressor\Http\Middleware;

use Closure;

class CheckUrl
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
        if (!filter_var($request->url, FILTER_VALIDATE_URL)) {
            abort(400, 'Bad Request');
        }

        return $next($request);
    }
}
