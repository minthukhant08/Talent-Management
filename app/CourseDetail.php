<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    protected $table = 'course_detail';
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
}
