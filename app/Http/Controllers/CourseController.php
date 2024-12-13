<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Faculty;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display a listing of courses under a specific faculty and institution
    public function index($institution_id, $faculty_id)
{
    // Fetch the institution and faculty based on the provided IDs
    $institution = Institution::findOrFail($institution_id);
    $faculty = Faculty::findOrFail($faculty_id);
    $courses = Course::where('faculty_id', $faculty_id)->get();

    // Pass the variables to the view
    return view('courses.index', compact('institution', 'faculty', 'courses'));
}


public function indexby($institution_id, $faculty_id)
{
    // Fetch the institution and faculty based on the provided IDs
    $institution = Institution::findOrFail($institution_id);
    $faculty = Faculty::findOrFail($faculty_id);
    $courses = Course::where('faculty_id', $faculty_id)->get();

    // Pass the variables to the view
    return view('courses.log', compact('institution', 'faculty', 'courses'),  ['institution_id' => $institution_id]);
}

    // Show the form for creating a new course under a specific faculty and institution
   // public function create($institutionId, $facultyId)
   // {
   //     return view('courses.create', compact('institutionId', 'facultyId'));
  //  }
  public function create($institution_id, $faculty_id)
{
    $institution = Institution::findOrFail($institution_id);
    return view('courses.create', [
        'institutionId' => $institution_id,
        'facultyId' => $faculty_id,
    ]);
}

public function log($institution_id, $faculty_id)
{
    $institution = Institution::findOrFail($institution_id);
    return view('courses.add', [
        'institutionId' => $institution_id,
        'facultyId' => $faculty_id,
    ]);
}


    // Store a newly created course under a specific faculty and institution
    public function store(Request $request, $institutionId, $facultyId)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $faculty = Faculty::findOrFail($facultyId);

        // Create a new course under the specified faculty
        $course = new Course();
        $course->name = $validatedData['course_name'];
        $course->level = $validatedData['level'];
        $course->duration = $validatedData['duration'];
        $course->faculty_id = $faculty->id;
        $course->save();

        return redirect()->route('faculties.courses.index', ['institutionId' => $institutionId, 'facultyId' => $facultyId])
                         ->with('success', 'Course created successfully!');
    }


     // Store a newly created course under a specific faculty and institution
     public function storeByInstitution(Request $request, $institutionId, $facultyId)
     {
         $validatedData = $request->validate([
             'course_name' => 'required|string|max:255',
             'level' => 'required|string|max:255',
             'duration' => 'required|string|max:255',
         ]);
 
         $faculty = Faculty::findOrFail($facultyId);
 
         // Create a new course under the specified faculty
         $course = new Course();
         $course->name = $validatedData['course_name'];
         $course->level = $validatedData['level'];
         $course->duration = $validatedData['duration'];
         $course->faculty_id = $faculty->id;
         $course->save();
 
         return redirect()->route('faculties.courses.indexby', ['institutionId' => $institutionId, 'facultyId' => $facultyId])
                          ->with('success', 'Course created successfully!');
     }
}
