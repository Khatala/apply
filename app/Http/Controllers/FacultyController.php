<?php

// app/Http/Controllers/FacultyController.php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Institution; // Include Institution model
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index($institution_id)
    {
        $faculties = Faculty::where('institution_id', $institution_id)->with('institution')->get(); // Load faculties for specific institution
        $institution = Institution::findOrFail($institution_id);
        return view('faculties.index', compact('faculties', 'institution'));
    }
    public function apply($institutionId)
    {
        // Fetch faculties associated with the institution, including their courses
        $faculties = Faculty::where('institution_id', $institutionId)->with('courses')->get();
    
        // Pass the data to the view
        return view('institutions.apply', compact('faculties'));
    }
    public function create($institution_id)
    {
        $institution = Institution::findOrFail($institution_id); // Fetch the specific institution
        return view('faculties.create', compact('institution'));
    }

    public function addFacultyForm($institutionId)
{
    $institution = Institution::findOrFail($institutionId); // Fetch the institution by ID
    return view('faculties.add', compact('institution')); // Pass the institution data to the view
}

    // app/Http/Controllers/FacultyController.php

public function edit($institution_id, $faculty_id)
{
    $institution = Institution::findOrFail($institution_id);
    $faculty = Faculty::findOrFail($faculty_id);
    return view('faculties.edit', compact('faculty', 'institution'));
}

public function update(Request $request, $institution_id, $id)
{
    $faculty = Faculty::findOrFail($id);
    $faculty->update($request->all()); // Validate and update as necessary
    return redirect()->route('faculties.log', ['institution_id' => $institution_id])->with('success', 'Faculty updated successfully!');

    //return redirect()->route('faculties.index', $institution_id)->with('success', 'Faculty updated successfully!');
}

public function destroy($institution_id, $faculty_id)
{
    $faculty = Faculty::findOrFail($faculty_id);
    $faculty->delete();

    return redirect()->route('faculties.log', $institution_id)->with('success', 'Faculty deleted successfully!');
}
public function show($institution_id, $faculty_id)
{
    $institution = Institution::findOrFail($institution_id);
    $faculty = Faculty::findOrFail($faculty_id); // Fetch the faculty by ID or throw an error if not found
    return view('faculties.log', compact('faculties', 'institution')); // Return a view for displaying faculty details
}



public function log($institution_id)
{
    $faculties = Faculty::where('institution_id', $institution_id)->with('institution')->get(); // Load faculties for specific institution
    $institution = Institution::findOrFail($institution_id);
    return view('faculties.log', compact('faculties', 'institution')); // Ensure you have a view named faculties/log.blade.php
}



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty_code' => 'required|string|max:255',
            'sponsor_type' => 'required|string|max:255',
            'institution_id' => 'required|exists:institutions,id', // Validate institution_id
        ]);

        Faculty::create([
            'name' => $request->name,
            'faculty_code' => $request->faculty_code,
            'sponsor_type' => $request->sponsor_type,
            'institution_id' => $request->institution_id, // Correctly handle institution_id
        ]);

        return redirect()->route('faculties.index', $request->institution_id)->with('success', 'Faculty created successfully!');
    }


    public function storeByInstitution(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'faculty_code' => 'required|string|max:255',
        'sponsor_type' => 'required|string|max:255',
        'institution_id' => 'required|exists:institutions,id',
    ]);

    Faculty::create([
        'name' => $request->name,
        'faculty_code' => $request->faculty_code,
        'sponsor_type' => $request->sponsor_type,
        'institution_id' => $request->institution_id,
    ]);

    return redirect()->route('faculties.log', $request->institution_id)
                     ->with('success', 'Faculty added successfully by Institution!');
}

}
