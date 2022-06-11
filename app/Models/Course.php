<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [

        'name',
        'slug',
        'info',
        'user_id'
    ];
    use HasFactory;

    //relation with module
    public function module()
    {
        return $this->hasMany(Module::class);
    }
   public function enroll()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id');
    }

    //delete the module when course is deleted
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($course) { // before delete() method call this
            $course->module()->delete();
            // do the rest of the cleanup...
        });
    }
    //relation with users table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
     public function checkEnrollment()
    {
        return DB::table('course_enrolls')->where('user_id', auth()->user()->id)
            ->where('course_id', $this->id)->exists();
    }
}
