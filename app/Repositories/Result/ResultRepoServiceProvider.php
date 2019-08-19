<?php
namespace App\Repositories\Result;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Result\ResultRepositoryInterface;
use App\Repositories\Result\ResultRepository;


class ResultRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Result\ResultRepositoryInterface', 'App\Repositories\Result\ResultRepository');
  }
}
