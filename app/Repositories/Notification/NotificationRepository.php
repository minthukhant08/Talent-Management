<?php

namespace App\Repositories\Notification;

use App\Notification;
use App\Repositories\Notification\NotificationRepositoryInterface as NotificationInterface;

class NotificationRepository implements NotificationInterface
{
  public $notification;

  public function __construct(Notification $notification)
  {
     $this->notification = $notification;
  }

  public function find($id)
  {
     return $this->notification::find($id);
  }

  public function getByUserID($id)
  {
     return $this->notification::where('user_id', '=', $id)->get();
  }
  public function destroy($id)
  {
    return $this->notification::find($id)->delete();
  }


  public function store($data){
      $this->notification->fill($data);
      if ($this->notification->save()) {
        return $this->notification;
      }
  }

}
