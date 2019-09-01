<?php
namespace App\Repositories\Admin;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Admin\AdminRepository;


class AdminRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Admin\AdminRepositoryInterface', 'App\Repositories\Admin\AdminRepository');
  }
}
