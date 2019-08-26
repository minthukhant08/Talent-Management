<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'user';
    protected $fillable = [
        'image', 'name', 'email', 'uid', 'gender', 'phone_no', 'nrc_no', 'address', 'date_of_birth', 'type', 'course_id', 'batch_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function course()
    {
      return $this->belongsTo(Course::class);
    }

    public function batch()
    {
      return $this->belongsTo(Batch::class);
    }

    public function assignments()
    {
      return $this->hasMany(StudentAssignement::class, 'student_id');
    }



}
