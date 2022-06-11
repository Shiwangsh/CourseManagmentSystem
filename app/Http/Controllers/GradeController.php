<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Module;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class GradeController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles == 'student') {
            return redirect('/student/dashboard');
        }
        if (Auth::user()->roles == 'tutor') {
            $assignments = Assignment::with('module')
                ->join('modules', 'modules.id', 'assignments.module_id')
                ->join('users', 'users.id', '=', 'modules.user_id')
                ->select(['assignments.*'])
                ->where('users.id', '=', Auth::user()->id)
                ->get();
            $grades = Grade::with('assignment', 'user')->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('grades.index', compact('assignments', 'grades', 'users'));
        } else {
            $modules = Module::all();
            $grades = Grade::latest()->get();
            $assignments = Assignment::with('module')
                ->join('modules', 'modules.id', 'assignments.module_id')
                ->join('users', 'users.id', '=', 'modules.user_id')
                ->select(['assignments.*'])->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('grades.index', compact('grades', 'modules', 'users', 'assignments'));
        }
    }
    public function create()
    {
        return view('grades.index');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docs,docx',
        ]);
        $file = $request->file('file')->store('public/students/grades');

        $user = Grade::create([
            'remarks' => request('remarks'),
            'submited_date' => Date::now(),
            'assignment_id' => request('assignment_id'),
            'user_id' => request('user_id'),
            'scored_grade' => request('scored_grade'),
            'file' => $file,
        ]);
        return redirect()->back()->with('message', 'Grade added !');
    }
    public function edit($id)
    {
        $grade = Grade::where('id', $id)->first();

        if (Auth::user()->roles == 'tutor') {
            $assignments = Assignment::with('module')
                ->join('modules', 'modules.id', 'assignments.module_id')
                ->join('users', 'users.id', '=', 'modules.user_id')
                ->select(['assignments.*'])
                ->where('users.id', '=', Auth::user()->id)
                ->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('grades.edit', compact('grade', 'users', 'assignments'));
        } else {

            return view('grades.edit', compact('grade'));
        }
    }
    public function update(Request $request, $id)
    {

        $grade = Grade::find($id);
        $grade->user_id = request('user_id');
        $grade->assignment_id = request('assignment_id');
        $grade->scored_grade = request('scored_grade');
        $grade->remarks = request('remarks');
        if (!empty(request('file'))) {
            $file = $request->file('file')->store('public/students/grades');
            $grade->file = $file;
        } else {
            $grade->file = $grade->file;
        }
        $grade->update();

        return redirect()->route('grades.index')
            ->with('message', 'Grades Updated');
    }
    public function show(Grade $grade, $id)
    {
        $grade = Grade::where('id', $id)->first();
        $users = User::where('roles', 'tutor')->get();


        return view('grades.show', compact('grade', 'users'));
    }
    public function delete($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();
        return redirect()->back();
    }
}
