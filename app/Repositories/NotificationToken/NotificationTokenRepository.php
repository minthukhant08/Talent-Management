<?php

namespace App\Repositories\NotificationToken;

use App\NotificationToken;
use App\Repositories\NotificationToken\NotificationTokenRepositoryInterface as NotificationTokenInterface;

class NotificationTokenRepository implements NotificationTokenInterface
{
  public $notificationToken;

  public function __construct(NotificationToken $notificationToken)
  {
     $this->notificationToken = $notificationToken;
  }

  public function find($id)
  {
     return $this->notificationToken::find($id);
  }

  public function exist($id, $token)
  {
    $noti_token = $this->notificationToken::where([['user_id','=', $id],['token', '=', $token]])->first();
    // dd($token);
      if (isset($noti_token)) {
        return true;
      }else{
        return false;
      }
  }

  public function total()
  {
    return $this->notificationToken::count();
  }

  public function getByUserID($id)
  {
     return $this->notificationToken::where([['user_id', '=', $id],['subscribe', '=', 1]])
                 ->orderBy('created_at', 'desc')
                 ->get();
  }

  public function destroy($id)
  {
    return $this->notificationToken::find($id)->delete();
  }


  public function store($data){
      $this->notificationToken->fill($data);
      if ($this->notificationToken->save()) {
        return $this->notificationToken;
      }
  }

  public function update($request)
  {
    $this->notificationToken = $this->notificationToken::where([['user_id','=', $request['user_id']],['token', '=', $request['token']]])->first();
    $this->notificationToken->fill($request);
    if ($this->notificationToken->save()) {
        return $this->notificationToken;
    }
  }

}
