<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
     public function index()
    {
        if (Auth::user()->roles == 'student') {
            return redirect('/student/dashboard');
        }
        if (Auth::user()->roles == 'tutor') {
          
            $attendances = Attendance::with( 'user')->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('attendances.index', compact( 'attendances', 'users'));
        } else {
           $attendances = Attendance::with( 'user')->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('attendances.index', compact( 'attendances', 'users'));
        }
    }
    public function create()
    {
        return view('attendances.index');
    }
    public function store(Request $request)
    {
      
        $user = Attendance::create([
            'remarks' => request('remarks'),
            'date' => request('date'),
            'user_id' => request('user_id'),
            'status' => request('status'),
        ]);
        return redirect()->back()->with('message', 'Attendance added !');
    }
    public function edit($id)
    {
        $attendance = Attendance::where('id', $id)->first();

        if (Auth::user()->roles == 'tutor') {
              $attendances = Attendance::with( 'user')->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('attendances.edit', compact('attendance', 'users'));
        } else {

            $attendances = Attendance::with( 'user')->get();
            $users = User::where('roles', '=', 'student')->get();

            return view('attendances.edit', compact('attendance', 'users'));        }
    }
    public function update(Request $request, $id)
    {

        $attendance = Attendance::find($id);
        $attendance->user_id = request('user_id');
        $attendance->date = request('date');
        $attendance->status = request('status');
        $attendance->update();

        return redirect()->route('attendances.index')
            ->with('message', 'Attendances Updated');
    }
    public function show(Attendance $attendance, $id)
    {
        $attendance = Attendance::where('id', $id)->first();
        $users = User::where('roles', 'tutor')->get();


        return view('attendances.show', compact('attendance', 'users'));
    }
    public function delete($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect()->back();
    }
}
