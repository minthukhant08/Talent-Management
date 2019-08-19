<?php
namespace App\Repositories\Intake;

interface IntakeRepositoryInterface{
  public function getIntake();
  public function update($request);
}
