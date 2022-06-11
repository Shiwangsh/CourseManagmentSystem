<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'dob',
        'address',
        'contact',
        'gender',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) { // before delete() method call this
            $user->course()->delete();
            $user->module()->delete();
            $user->announcement()->delete();
            // do the rest of the cleanup...
        });
    }
    public function module()
    {
        return $this->hasMany(Module::class);
    }
    public function course()
    {
        return $this->hasMany(Course::class);
    }
    public function announcement()
    {
        return $this->hasMany(Announcement::class);
    }
     public function enroll()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id', 'id');
    }
}
