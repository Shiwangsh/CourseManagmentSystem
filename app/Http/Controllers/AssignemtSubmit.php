<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmit;
use Illuminate\Support\Facades\Auth;

class AssignemtSubmit extends Controller
{
    public function index()
    {
        return view('studentassignments.index');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docs,docx',
        ]);
        $file = $request->file('file')->store('public/students/assignment');

        $user = AssignmentSubmit::create([

            'module_id' => request('module_id'),
            'user_id' => Auth::user()->id,
            'assignment_id' => request('assignment_id'),
            'module_id' => request('module_id'),
            'file' => $file,
        ]);
        return redirect()->back()->with('message', 'Assignment submited !');
    }
}
