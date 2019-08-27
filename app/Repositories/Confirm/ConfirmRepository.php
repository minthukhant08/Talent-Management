<?php

namespace App\Repositories\Confirm;

use App\Confirm;
use App\Repositories\Confirm\ConfirmRepositoryInterface as ConfirmInterface;

class ConfirmRepository implements ConfirmInterface
{
  public $confirm;

  public function __construct(Confirm $confirm)
  {
     $this->confirm = $confirm;
  }

  public function find($id)
  {
     return $this->confirm::find($id);
  }

  public function getByUserID($id)
  {
     return $this->confirm::where('user_id', '=', $id)
                 ->orderBy('created_at', 'desc')
                 ->get();
  }


  public function destroy($id)
  {
    return $this->confirm::find($id)->delete();
  }


  public function store($data){
      $this->confirm->fill($data);
      if ($this->confirm->save()) {
        return $this->confirm;
      }
  }

}
