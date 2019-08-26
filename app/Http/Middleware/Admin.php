<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin as AdminModel;

class Admin
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
      $admin = AdminModel::find($request->admin_id);

      if (isset($admin)) {
        if ($admin->role > 1) {
          return response('501');
        }
      }else{
         return response('501');
      }
        return $next($request);
    }
}
