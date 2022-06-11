<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Course;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $courses =  Course::all();        
                
        return view('student.index', compact('courses'));
    }
    public function profile()
    {
        return view('profile');
    }
    //update profile

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'fname' => ['required'],
            'lname' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'fname' => request('fname'),
            'lname' => request('lname'),
            'address' => request('address'),
            'email' => request('email'),

        ]);

        dd('Password change successfully.');
    }
    public function tutor()
    {
        $courses =   Course::where('courses.user_id', '=', Auth::user()->id)
            ->select(['courses.id', 'courses.name', 'courses.info', 'courses.slug', 'courses.updated_at'])->get();
        return view('tutor.index', compact('courses', 'courses'));
    }
    public function admin()
    {
        return view('admin.index');
    }
    public function users()
    {
        $users = User::latest()->paginate(5);
        return view('admin.users', compact('users'));
    }
    public function edit(User $user, $id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fname = request('fname');
        $user->lname = request('lname');
        $user->address = request('address');
        $user->roles = request('roles');
        $user->update();

        return redirect()->route('admin.users')
            ->with('message', 'User updated successfully');
    }
    public function store(Request $request)
    {
        $user = User::create([
            'fname' => request('fname'),
            'lname' => request('lname'),
            'email' => request('email'),
            'dob' => request('dob'),
            'contact' => request('contact'),
            'address' => request('address'),
            'gender' => request('gender'),
            'roles' => request('roles'),
            'password' =>  Hash::make(request('password')),
        ]);
        return redirect()->back()->with('message', 'User added !');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
    public function studentGrade()
    {
        $grades = Grade::where('grades.user_id', '=', Auth::user()->id)->get();
        return view('student.grade', compact('grades'));
    }
}
