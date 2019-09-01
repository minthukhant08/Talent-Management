<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationToken extends Model
{
    protected $table = 'notification_token';
    protected $fillable = [
        'user_id', 'token', 'subscribe'
    ];

    public function user()
    {
      return $this->hasOne(User::class);
    }
}
