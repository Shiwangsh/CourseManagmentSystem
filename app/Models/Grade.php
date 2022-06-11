<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [

        'assignment_id',
        'remarks',
        'file',
        'submited_date',
        'scored_grade',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($file) {

            Storage::disk('public')->delete('/students/assignments/' . $file);
        });
    }
}
