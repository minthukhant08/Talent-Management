<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
// use App\Repositories\Admin\AdminRepositoryInterface as AdminInterface;

class Superadmin
{
    // public $adminInterface;
    // public function __construct(AdminInterface $adminInterface)
    // {
    //    $this->adminInterface = $adminInterface;
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // $this->adminInterface = new AdminInterface();
      // $admin = $this->adminInterface::find($request->admin_id)->first();
      $admin = Admin::find($request->admin_id);

      if (isset($admin)) {
        if ($admin->role != 0) {
          return response('501');
        }
      }else{
         return response('501');
      }
        return $next($request);
    }
}
