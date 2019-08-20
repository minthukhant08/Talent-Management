<?php
namespace App\Repositories\Topic;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\Topiic\TopicRepository;


class TopicRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Topic\TopicRepositoryInterface', 'App\Repositories\Topic\TopicRepository');
  }
}
