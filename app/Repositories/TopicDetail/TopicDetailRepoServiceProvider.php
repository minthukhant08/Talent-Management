<?php
namespace App\Repositories\TopicDetail;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TopicDetail\TopicDetailRepositoryInterface;
use App\Repositories\TopicDetail\TopicDetailRepository;


class TopicDetailRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\TopicDetail\TopicDetailRepositoryInterface', 'App\Repositories\TopicDetail\TopicDetailRepository');
  }
}
