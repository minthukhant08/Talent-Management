<?php

namespace App\Repositories\Intake;

use App\Intake;
use App\Http\ApiControllers\IntakeAvailableEvent;
use App\Repositories\Intake\IntakeRepositoryInterface as IntakeInterface;

class IntakeRepository implements IntakeInterface
{
  public $intake;

  public function __construct(Intake $intake)
  {
     $this->intake = $intake;
  }


  public function getIntake()
  {
    return $this->intake::first();
  }

  public function update($request)
  {
    $this->intake = $this->intake::first();
    $this->intake->fill($request);
    if ($this->intake->save()) {
        return $this->intake;
    }
  }
}
