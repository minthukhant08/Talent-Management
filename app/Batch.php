<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch';
    protected $fillable = [
        'name', 'start_date', 'end_date'
    ];
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function users()
    {
      return $this->hasMany(User::class);
    }

}
