<?php
namespace App\Repositories\Notification;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\Notification\NotificationRepository; 


class NotificationRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Notification\NotificationRepositoryInterface', 'App\Repositories\Notification\NotificationRepository');
  }
}
