<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topic';
    protected $fillable = [
        'course_id', 'topic', 'descriptions', 'start_date', 'end_date'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function course()
    {
      return $this->belongsTo(Course::class);
    }

    public function details(){
      return $this->hasMany(TopicDetail::class);
    }
    public function teacher(){
      return $this->hasOne(User::class);
    }
}
