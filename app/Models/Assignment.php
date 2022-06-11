<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
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
        'deadline',
        'module_id',
        'file'
    ];
    use HasFactory;
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($file) {

            Storage::disk('public')->delete('/tutor/assignments/' . $file);
        });
    }
}
