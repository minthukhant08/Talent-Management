<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Assignment extends Model
{
    protected $table = 'assignment';
    protected $fillable = [
        'name', 'teacher_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function studentAssignments()
    {
      return $this->hasMany(User::class);
    }

    public function teacher()
    {
      return $this->hasOne(User::class);
    }

}
