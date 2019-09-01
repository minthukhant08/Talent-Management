<?php
namespace App\Repositories\NotificationToken;

use Illuminate\Support\ServiceProvider;
use App\Repositories\NotificationToken\NotificationTokenRepositoryInterface;
use App\Repositories\NotificationToken\NotificationTokenRepository;


class NotificationTokenRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\NotificationToken\NotificationTokenRepositoryInterface', 'App\Repositories\NotificationToken\NotificationTokenRepository');
  }
}
