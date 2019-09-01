<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  protected $table = 'admin';
  protected $fillable = [
      'image', 'name', 'email', 'uid', 'role'
  ];

  public function logs()
  {
     return $this->hasMany(Log::class);
  }

}
