<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Tutor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        //student
        if (Auth::user()->roles == 'student') {
            return redirect()->route('tutor.index');
        }
        //tutor
        if (Auth::user()->roles == "tutor") {
            return $next($request);
        }
        //admin
        if (Auth::user()->roles == "admin") {
            return redirect()->route('admin.index');
        }
    }
}
