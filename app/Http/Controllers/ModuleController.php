<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request)
    {
        $module = Module::create([
            'name' => request('name'),
            'info' => request('info'),
            'course_id' => request('course_id'),
            'user_id' => request('user_id'),
        ]);
        return redirect()->back()->with('message', 'Module added !');
    }
    public function delete($slug)
    {
        $module = Module::findOrFail($slug);
        $module->delete();
        return redirect()->back()->with('message', 'Module deleted !');
    }
    public function edit(Module $module, $slug)
    {
        $module = Module::with('courses')->where('slug', $slug)->first();
        return view('modules.edit', compact('module'));
    }
    public function update(Request $request, $slug)
    {
        $module = Module::find($slug);
        $module->name = request('name');
        $module->info = request('info');
        $module->update();
        $mId = $module->courses->slug;

        return redirect('/courses/show/' . $mId)
            ->with('message', 'Module updated successfully');
    }
}
