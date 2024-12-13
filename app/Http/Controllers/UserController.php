<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $courses = Course::all();
        $appliedCourses = Auth::user()->courses;

        return view('users.dashboard', compact('courses', 'appliedCourses'));
    }
}


