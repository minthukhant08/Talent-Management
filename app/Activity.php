<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    protected $fillable = [
        'name', 'date', 'descriptions', 'speaker_name', 'image', 'type'
    ];
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }
}
