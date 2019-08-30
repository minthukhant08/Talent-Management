<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Assignment extends Model
{
    protected $table = 'assignment';
    protected $fillable = [
        'name', 'teacher_id','created_at',
    ];
    protected $hidden = [
       'updated_at'
    ];

    public function studentAssignments()
    {
      return $this->hasMany(User::class);
    }

    public function teacher()
    {
      return $this->belongsTo(User::class);
    }

}
