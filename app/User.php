<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $table = 'user';
    protected $fillable = [
        'image', 'name', 'email', 'gender', 'phone_no', 'nrc_no', 'address', 'date_of_birth', 'type', 'course_id', 'batch_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'image'
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
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

}
