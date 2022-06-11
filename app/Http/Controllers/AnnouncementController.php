<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles == 'tutor') {
            $announcements =   Announcement::where('announcements.user_id', '=', Auth::user()->id)
                ->select(['announcements.*'])->get();
            return view('announcements.index', compact('announcements'));
        } else {
            $announcements = Announcement::latest()->get();
            return view('announcements.index', compact('announcements'));
        }
    }
    public function create()
    {
        return view('announcements.index');
    }
    public function store(Request $request)
    {
        $user = Announcement::create([
            'title' => request('title'),
            'info' => request('info'),
            'announce_date' => request('announce_date'),
            'user_id' => request('user_id'),
        ]);
        return redirect()->back()->with('message', 'announcements added !');
    }
    public function edit($slug)
    {
        $announcement = Announcement::where('slug', $slug)->first();


        return view('announcements.edit', compact('announcement'));
    }
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $announcement->title = request('title');
        $announcement->info = request('info');
        $announcement->announce_date = request('announce_date');
        $announcement->update();

        return redirect()->route('announcements.index')
            ->with('message', 'Announcements updated successfully');
    }
    public function show(Announcement $announcement, $slug)
    {
        $announcement = Announcement::where('slug', $slug)->first();
        $users = User::where('roles', 'tutor')->get();
        return view('announcements.show', compact('announcement', 'users'));
    }
    public function delete($slug)
    {
        $announcement = Announcement::findOrFail($slug);
        $announcement->delete();
        return redirect()->back();
    }
}
