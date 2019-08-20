<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicDetail extends Model
{
    protected $table = 'topic_detail';
    protected $fillable = [
        'topic_id', 'name', 'descriptions', 'date', 'teacher_id', 'topic_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function Topic($value='')
    {
      return $this->hasOne(Topic::class);
    }

    public function teacher($value='')
    {
      return $this->hasOne(User::class);
    }
}
