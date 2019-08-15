<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = [
        'user_id', 'activity_id', 'descriptions'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function activity()
    {
      return $this->belongsTo(Activity::class);
    }
}
