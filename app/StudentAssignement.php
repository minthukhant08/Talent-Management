<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAssignement extends Model
{
    protected $table = 'student_assignment';
    protected $fillable = [
        'student_id', 'assignment_id', 'marks'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public function assignment()
    {
      return $this->belongsTo(Assignment::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
