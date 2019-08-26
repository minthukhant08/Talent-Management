<?php
namespace App\Repositories\Log;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Log\LogRepositoryInterface;
use App\Repositories\Log\LogRepository;


class LogRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Log\LogRepositoryInterface', 'App\Repositories\Log\LogRepository');
  }
}
