<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    protected $table = 'intake';
    protected $fillable = [
        'available', 'from_link';
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ]
}
