<?php
namespace App\Repositories\Assignment;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Assignment\AssignmentRepositoryInterface;
use App\Repositories\Assignment\AssignmentRepository;


class AssignmentRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
      $this->app->bind('App\Repositories\Assignment\AssignmentRepositoryInterface', 'App\Repositories\Assignment\AssignmentRepository');
  }
}
