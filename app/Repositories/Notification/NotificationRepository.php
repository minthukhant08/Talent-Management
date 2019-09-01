<?php

namespace App\Repositories\Notification;

use App\Notification;
use Illuminate\Support\Facades\DB;
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

  public function getByUserID($id,$limit)
  {
     return $this->notification::with('confirmation')->where('user_id', '=', $id)
                 ->orderBy('created_at', 'desc')
                 ->take($limit)
                 ->get();
  }

  public function getUnseen($id)
  {
     return $this->notification::with('confirmation')->where([['user_id', '=', $id],['seen', '=', 0]])->get()->count();
  }

  public function seeAll($user_id)
  {
     DB::table('notification')->where('user_id', $user_id)->update(["seen" => 1]);
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
