<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentSubmit extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [

        'module_id',
        'user_id',
        'assignment_id',
        'file'
    ];
}
