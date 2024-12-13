<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // This method will show products page
    public function index($institutionId) {
        $institution = Institution::find($institutionId);
        $products = Product::orderBy('created_at','DESC')->get();
        
        $products = Product::all(); // Adjust this according to your actual model and data retrieval logic
    
    // Return the view and pass the products variable
  // return view('welcome', compact('products'));

        return view('institutions.notifications',compact('institutions'),[
            'products' => $products
        ]);


    }



    // This method will show create product page
    public function create() {
        return view('application-form');
    }

 
    public function store(Request $request) {

        $institutions = Institution::all();
        $courses = \App\Models\Course::all();
        // Validation rules for all the fields
        $rules = [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'mother_name' => 'nullable|min:2',
            'father_name' => 'nullable|min:2',
            'address' => 'required|min:5',
            'gender' => 'required|in:Female,Male,Other',
            'course_name' => 'nullable|in:' . implode(',', $courses->pluck('name')->toArray()),
            'district' => 'required|in:Berea,Butha-Buthe,Leribe,Mafeteng,Maseru,Mohale s Hoek,Mokhotlong,Qacha s Nek,Quthing,Thaba-Tseka',
            'dob' => 'required|date|before:today',
            'email' => 'required|email|unique:products,email',  // Replace 'users' with your table name
            'results' => 'nullable|file|max:51200|mimes:pdf,jpg,jpeg,png',
            'institution_id' => 'required|exists:institutions,id', // Validate institution_id
            
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Save user data
        $product = new Product(); // Replace `User` with your model name
        $product->first_name = $request->first_name;
        $product->last_name = $request->last_name;
        $product->mother_name = $request->mother_name;
        $product->father_name = $request->father_name;
        $product->address = $request->address;
        $product->gender = $request->gender;
        $product->course_name = $request->course_name;
        $product->district = $request->district;
        $product->dob = $request->dob;
        $product->email = $request->email;
        $product->institution_id = $request->institution_id;
    
        // File upload for results
        if ($request->hasFile('results')) {
            $file = $request->file('results');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/results'), $filename); // Store in uploads/results directory
            $product->results = $filename; // Save filename in database
        }
    
        $product->save();
    
        return view('welcome',compact('institutions'), ['products' => Product::all()])->with('success', 'Application submitted successfully.');
    }
    


public function admit($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Update the status to 'Admitted' (case-sensitive)
    $product->status = 'Admitted';

    // Save the changes
    $product->save();

    return redirect()->back()->with('success', 'applicant status updated to Admitted.');
}


public function admittedList()
{
    
    // Fetch only admitted products with their associated institution
    $admittedProducts = Product::where('status', 'admitted')
                                ->with('institution') // Eager-load the institution relationship
                                ->get(); // Fetch only admitted products.
    return view('products.admitted', compact('admittedProducts'));
}


    // This method will update a product


    // This method will delete a product
    public function destroy($id) {
        $product = Product::findOrFail($id);

        $institution = Institution::findOrFail($id);
       // delete image
       File::delete(public_path('uploads/products/'.$product->image));

       // delete product from database
       $product->delete();

       return redirect()->route('institutions.notifications', compact('institution'))->with('success','student deleted successfully.');
    }



    public function notifications($institution_id)
{
    // Fetch products for the institution
    $products = Product::where('institution_id', $institution_id)
        ->orderBy('created_at', 'DESC')
        ->with('institution')
        ->get();

    // Fetch the institution details
    $institution = Institution::findOrFail($institution_id);

    // Pass the data to the view
    return view('institutions.notifications', compact('products', 'institution'));
}

    


}
