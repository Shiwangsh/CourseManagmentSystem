<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseEnroll extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id'
    ];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
     public function checkApplication()
    {
        return DB::table('course_enrolls')->where('user_id', auth()->user()->id)
            ->where('course_id', $this->id)->exists();
    }
}
