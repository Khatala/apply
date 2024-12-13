<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Institution;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use Illuminate\Http\Request;


class ApplicationController extends Controller
{


    public function showApplicationForm($facultyId)
    {
        $faculty = Faculty::findOrFail($facultyId);
        $institution = $faculty->institution;
        $courses = $faculty->courses; // Assuming a relationship exists

        return view('application-form', [
            'institution' => $institution,
            'faculty' => $faculty,
            'courses' => $courses,
        ]);
    }


    // Show the application form for a specific institution
    public function create($institutionId)
    {
        $institution = Institution::with('faculties.courses')->findOrFail($institutionId);

        return view('institutions.apply', compact('institution'));
    }



    // Store the application data


    public function store(Request $request, Faculty $faculty)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required',
            'course_id' => 'required|exists:courses,id',
            'district' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|unique:applications,email',
            'results_file' => 'required|file|max:51200',
        ]);

        $filePath = $request->file('results_file')->store('results', 'public');

        Application::create(array_merge($request->all(), [
            'faculty_id' => $faculty->id,
            'results_file' => $filePath,
        ]));

        return redirect()->route('dashboard')->with('success', 'Application submitted successfully.');
    }


    public function dashboard()
    {
        $applications = Application::where('status', 'Pending')->get();
        return view('dashboard', compact('applications'));
    }


    

    public function index()
    {
        $applications = Application::with('course')->get();
        return view('notifications', compact('applications'));
    }

    public function notifications()
    {
        // Fetch all applications for admin
        $applications = Application::latest()->get();
        return view('notifications', compact('applications'));
    }
}
