<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    protected $table = 'confirm';
    protected $fillable = [
        'user_id', 'noti_id', 'code'
    ];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
