<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [

        'title',
        'slug',
        'info',
        'announce_date',
        'user_id'
    ];
    use HasFactory;
}
