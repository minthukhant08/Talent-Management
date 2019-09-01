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

  public function confirm($user_id, $code)
  {
     return $this->confirm::with('user')->where([['user_id', '=', $user_id], ['code', '=', $code]])->first();
  }

  public function getByUserID($id)
  {
     return $this->confirm::where('user_id', '=', $id)
                 ->orderBy('created_at', 'desc')
                 ->get();
  }

  public function total()
  {
    return $this->confirm::count();
  }

  public function getAll($offset, $limit, $name){
    return $this->confirm::with('user')->orderBy('created_at', 'desc')
        ->whereHas('user', function($query) use ($name) {
          $query->where('name', 'like', '%'.$name.'%');
          })
        ->skip($offset)
        ->take($limit)
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
