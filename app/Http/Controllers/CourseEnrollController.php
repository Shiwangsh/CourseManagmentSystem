<?php

namespace App\Http\Controllers;

use App\Models\CourseEnroll;
use Illuminate\Http\Request;

class CourseEnrollController extends Controller
{
    public function store(Request $request)
    {
        $user = CourseEnroll::create([
            'user_id' => auth()->user()->id,
            'course_id' => request('course_id'),
        ]);
        return redirect()->back()->with('message', 'You Enrolled to the courses !');
    }
}
