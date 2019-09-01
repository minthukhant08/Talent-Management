<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Scanner
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
        $scanner = User::find($request->scanner_id);

        if (!isset($scanner)) {
            return response('501');
        }
          return $next($request);
    }
}
