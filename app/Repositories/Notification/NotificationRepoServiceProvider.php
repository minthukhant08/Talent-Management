<?php
namespace App\Repositories\Notification;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Notification\NotificationRepositoryInterface as NotificationInterface;
use App\Repositories\Notification\NotificationRepository as NotificationRepo;


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
