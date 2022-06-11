<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //major middleware function for admin route
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        //student
        if (Auth::user()->roles == 'student') {
            return redirect()->route('student.index');
        }
        //tutor
        if (Auth::user()->roles == "tutor") {
            return redirect()->route('tutor.index');
        }
        //admin
        if (Auth::user()->roles == "admin") {
            return $next($request);
        }
    }
}
