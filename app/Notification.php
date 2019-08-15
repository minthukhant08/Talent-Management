<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $fillable = [
        'type', 'title', 'descriptions', 'date', 'user_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
