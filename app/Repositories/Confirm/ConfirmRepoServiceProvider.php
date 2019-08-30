<?php
namespace App\Repositories\Confirm;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Confirm\ConfirmRepositoryInterface;
use App\Repositories\Confirm\ConfirmRepository;


class ConfirmRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Confirm\ConfirmRepositoryInterface', 'App\Repositories\Confirm\ConfirmRepository');
  }
}
