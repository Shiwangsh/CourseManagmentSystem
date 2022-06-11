<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{

    public function index()
    {
        if (Auth::user()->roles == 'student') {
            return redirect('/student/dashboard');
        }
        if (Auth::user()->roles == 'admin') {
            $users = User::where('roles', 'tutor')->get();
            $courses = Course::latest()->get();
            return view('courses.index', compact('courses', 'users'));
        } else {
            $courses =   Course::where('courses.user_id', '=', Auth::user()->id)
                ->select(['courses.id', 'courses.name', 'courses.info', 'courses.slug'])->get();
            return view('courses.index', compact('courses'));
        }
    }
    public function create()
    {
        return view('courses.index');
    }
    public function store(Request $request)
    {
        $user = Course::create([
            'name' => request('name'),
            'info' => request('info'),
            'user_id' => request('user_id'),
        ]);
        return redirect()->back()->with('message', 'Courses added !');
    }
    public function edit($slug)
    {
        if (Auth::user()->roles == 'student') {
            return redirect('/student/dashboard');
        }
        $course = Course::where('slug', $slug)->first();


        return view('courses.edit', compact('course'));
    }
    public function update(Request $request, $slug)
    {
        $course = Course::find($slug);
        $course->name = request('name');
        $course->info = request('info');
        $course->update();

        return redirect()->route('courses.index')
            ->with('message', 'Courses updated successfully');
    }
    public function show(Course $course, $slug)
    {
        $course = Course::where('slug', $slug)->first();
        $modules = Module::where('course_id', $course->id)->with('user')->oldest()->get();
        $users = User::where('roles', 'tutor')->get();
        return view('courses.show', compact('course', 'users', 'modules'));
    }
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->back();
    }
}
