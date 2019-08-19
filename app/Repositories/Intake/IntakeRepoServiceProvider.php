<?php
namespace App\Repositories\Intake;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Intake\IntakeRepositoryInterface;
use App\Repositories\Intake\IntakeRepository;


class IntakeRepoServiceProvider extends ServiceProvider
{

  public function boot()
  {
    // code...
  }

  public function register()
  {
    $this->app->bind('App\Repositories\Intake\IntakeRepositoryInterface', 'App\Repositories\Intake\IntakeRepository');
  }
}
