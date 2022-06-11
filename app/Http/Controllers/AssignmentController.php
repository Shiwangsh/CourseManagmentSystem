<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignment;
use App\Models\AssignmentSubmit;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles == 'tutor') {
            // $assignments =   Assignment::join('modules', 'modules.id', '=', 'assignments.module_id')->where('assignments.module_id', '=', Auth::user()->id)
            //     ->select(['assignments.*'])->get();
            $assignments = Assignment::with('module')
                ->join('modules', 'modules.id', 'assignments.module_id')
                ->join('users', 'users.id', '=', 'modules.user_id')
                ->select(['assignments.*'])
                ->where('users.id', '=', Auth::user()->id)
                ->get();
            $modules =   Module::where('modules.user_id', '=', Auth::user()->id)
                ->select(['modules.*'])->get();
            return view('assignments.index', compact('assignments', 'modules'));
        } else {
            $modules = Module::all();
            $assignments = Assignment::latest()->get();
            return view('assignments.index', compact('assignments', 'modules'));
        }
    }
    public function create()
    {
        return view('assignments.index');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docs,docx',
        ]);
        $file = $request->file('file')->store('public/tutor/assignments');

        $user = Assignment::create([
            'title' => request('title'),
            'info' => request('info'),
            'deadline' => request('deadline'),
            'module_id' => request('module_id'),
            'file' => $file,
        ]);
        return redirect()->back()->with('message', 'Assignment added !');
    }
    public function edit($id)
    {
        $assignment = Assignment::where('slug', $id)->first();

        if (Auth::user()->roles == 'tutor') {
            $modules =   Module::where('modules.user_id', '=', Auth::user()->id)
                ->select(['modules.*'])->get();
            return view('assignments.edit', compact('assignment', 'modules'));
        } else {
            $modules = Module::all();
            return view('assignments.edit', compact('assignment', 'modules'));
        }
    }
    public function update(Request $request, $id)
    {

        $assignment = Assignment::find($id);
        $assignment->title = request('title');
        $assignment->info = request('info');
        $assignment->deadline = request('deadline');
        if (!empty(request('file'))) {
            $file = $request->file('file')->store('public/tutor/assignments');
            $assignment->file = $file;
        } else {
            $assignment->file = $assignment->file;
        }
        $assignment->update();

        return redirect()->route('assignments.index')
            ->with('message', 'assignments updated successfully');
    }
    public function show(assignment $assignment, $id)
    {
        $assignment = Assignment::where('slug', $id)->first();
        $users = User::where('roles', 'tutor')->get();

        $submits = AssignmentSubmit::join('assignments', 'assignment_submits.assignment_id', 'assignments.id')
            ->where('assignment_submits.assignment_id', '=', $assignment->id)
            ->where('assignment_submits.user_id', Auth::user()->id)
            ->select('assignment_submits.*')
            ->oldest()->get();

        return view('assignments.show', compact('assignment', 'users', 'submits'));
    }
    public function delete($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();
        return redirect()->back();
    }
}
