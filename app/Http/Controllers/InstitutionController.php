<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    // This method will show institutions page
    public function index() {
        $institutions = Institution::orderBy('created_at','DESC')->get();

        $institutions = Institution::all(); // Adjust this according to your actual model and data retrieval logic
    
        // Return the view and pass the institutions variable
        return view('institutions.list',[
            'institutions' => $institutions
        ]);
    }
    
    public function apply1($institutionId)
    {
        // Fetch the institution
        $institution = Institution::findOrFail($institutionId);
    
        // Fetch faculties associated with the institution, including their courses
        $faculties = Faculty::where('institution_id', $institutionId)->with('courses')->get();
    
        // Pass both institution and faculties to the view
        return view('institutions.apply', compact('institution', 'faculties'));
    }

    public function userInstitutions()
{
    // Fetch institutions for the dropdown
    $institutions = Institution::all();

    // Pass data to the view
    return view('welcome', compact('institutions'));
}


public function apply($id)
{
    $institution = Institution::findOrFail($id);
    return view('institutions.apply', compact('institution'));
}






    // This method will show create institution page
    public function create() {
        return view('institutions.create');
    }

    public function showRegisterForm(){
        return view('institutions.register');
    }

        // Handle the registration form submission
        public function Registerstore(Request $request) {
            $rules = [
                'name' => 'required|min:3',
                'password' => 'required|min:6|confirmed', 
                'email' => 'required|email|unique:institutions,email',            
            ];
    
            if ($request->image != "") {
                $rules['image'] = 'image';
            }
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return redirect()->route('institutions.register')->withInput()->withErrors($validator);
            }
    
            // here we will insert institution in db
            $institution = new Institution();
            $institution->name = $request->name;
            $institution->password = bcrypt($request->password); // Store hashed password
            $institution->email = $request->email;
            $institution->save();
    
            if ($request->image != "") {
                // here we will store image
                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().'.'.$ext; // Unique image name
    
                // Save image to institutions directory
                $image->move(public_path('uploads/institutions'), $imageName);
    
                // Save image name in database
                $institution->image = $imageName;
                $institution->save();
            }        
    
            // Redirect to login page after successful registration
            return redirect()->route('institutions.login')->with('success', 'Institution registered successfully!');
        }

    // This method will store an institution in db
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:3',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|unique:institutions,email',            
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('institutions.create')->withInput()->withErrors($validator);
        }

        // here we will insert institution in db
        $institution = new Institution();
        $institution->name = $request->name;
        $institution->password = bcrypt($request->password); // Store hashed password
        $institution->email = $request->email;
        $institution->save();

        if ($request->image != "") {
            // here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // Unique image name

            // Save image to institutions directory
            $image->move(public_path('uploads/institutions'), $imageName);

            // Save image name in database
            $institution->image = $imageName;
            $institution->save();
        }        

        return redirect()->route('institutions.index')->with('success', 'Institution added successfully.');
    }
    public function show()
    {
        return view('institutions.register');
    }


/*

  public function show()
    {
        return view('institutions.register');
    }
    public function dash($id)
    {
        $institution = Institution::findOrFail($id);
        $faculties = Faculty::where('institution_id', $id)->get();
    
        return view('institutions.dashboard', compact('institution', 'faculties'));
    }
*/




    // Show the login form
    public function showLoginForm()
    {
        return view('institutions.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Attempt to authenticate institution
        if (Auth::guard('institution')->attempt($credentials)) {
            // Get the authenticated institution
            $institution = Auth::guard('institution')->user();
    
            // Retrieve faculties associated with the institution
            $faculties = $institution->faculties; // Assuming the relationship is named 'faculties'
    
            // Pass the institution and faculties to the view
            return view('faculties.log', compact('faculties', 'institution'));
        } else {
            return back()->with('error', 'Invalid login credentials');
        }
    }
    

    // Logout the institution
    public function logout(Request $request)
    {
        Auth::guard('institution')->logout();
        return redirect()->route('404');
    }

    // This method will show edit institution page
    public function edit($id) {
        $institution = Institution::findOrFail($id);
        return view('institutions.edit', [
            'institution' => $institution
        ]);
    }
    public function list()
{
    $institutions = Institution::all(); // Get all institutions
    return view('institutions.list', compact('institutions'));
}

    // This method will update an institution
    public function update($id, Request $request) {

        $institution = Institution::findOrFail($id);

        $rules = [
            'name' => 'required|min:3',
            'password' => 'required|min:6,'. $institution->id,
            'email' => 'required|email|unique:institutions,email,' . $institution->id,

        ];
        

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('institutions.edit', $institution->id)->withInput()->withErrors($validator);
        }

        // here we will update institution
        // Update the institution details
    $institution->name = $request->name;
    $institution->email = $request->email;

    // If password is provided, hash it and update it
    if ($request->password) {
        $institution->password = bcrypt($request->password);
    }

    // Save updated institution
    $institution->save();

        if ($request->image != "") {

            // delete old image
            File::delete(public_path('uploads/institutions/'.$institution->image));

            // here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // Unique image name

            // Save image to institutions directory
            $image->move(public_path('uploads/institutions'), $imageName);

            // Save image name in database
            $institution->image = $imageName;
            $institution->save();
        }
        
        $institution = Auth::guard('institution')->user();
    
        // Retrieve faculties associated with the institution
        $faculties = $institution->faculties; // Assuming the relationship is named 'faculties'

        // Pass the institution and faculties to the view
        return view('faculties.log', compact('faculties', 'institution'))->with('success', 'Institution updated successfully.');

        
    }

    // This method will delete an institution
    public function destroy($id) {
        $institution = Institution::findOrFail($id);

        // delete image
        File::delete(public_path('uploads/institutions/'.$institution->image));

        // delete institution from database
        $institution->delete();

        return redirect()->route('institutions.index')->with('success', 'Institution deleted successfully.');
    }
    
}
