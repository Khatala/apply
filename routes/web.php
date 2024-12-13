<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ApplicationController;

Route::get('/applications/create/{institution}', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
Route::get('/institution/{institutionId}/apply', [InstitutionController::class, 'apply1'])->name('institution.apply');




Route::get('/faculties/log/{institution_id}', [InstitutionController::class, 'log'])->name('faculties.log');



Route::get('/about-us', function () {
    return view('about'); // This will look for `resources/views/about.blade.php`
});

Route::get('/contact-us', function () {
    return view('contact'); // This will look for `notification/views/contact.blade.php`
});
Route::get('/courses', function () {
    return view('courses'); // resources/views/courses.blade.php
});

Route::get('/team', function () {
    return view('team'); // resources/views/team.blade.php
});

Route::get('/testimonial', function () {
    return view('testimonial'); // resources/views/testimonial.blade.php
});

Route::get('/404', function () {
    return view('404'); // resources/views/404.blade.php
});





// Admin Registration Routes
Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');

// Admin Login Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Admin Logout Route
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Dashboard Route (Protected)
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
});





Route::post('/application-form/{faculty}', [ApplicationController::class, 'store'])->name('application.store');
Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('products.create');







Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::controller(InstitutionController::class)->group(function(){
    Route::get('/institutions','index')->name('institutions.index');
    Route::get('/institutions/create','create')->name('institutions.create');
    Route::get('institutions/login', 'show')->name('institutions.login');
    Route::post('institutions/login', 'login')->name('institutions.login.submit');
        // Show login form for institutions
    Route::get('institutions/login','showLoginForm')->name('institutions.login');

    // Handle the login form submission
    Route::post('institutions/login', 'login')->name('institutions.login.submit');

    // Dashboard
    Route::get('/institutions/{id}/dash', 'dash')->name('institutions.dash');
    // Logout
    Route::post('institutions/logout', 'logout')->name('institutions.logout');

    Route::post('/institutions','store')->name('institutions.store');
    Route::get('/institutions/{institution}/edit','edit')->name('institutions.edit');
    Route::put('/institutions/{institution}','update')->name('institutions.update');
    Route::delete('/institutions/{institution}','destroy')->name('institutions.destroy');    
});





Route::post('/products/{id}/admit', [ProductController::class, 'admit'])->name('products.admit');
Route::get('/products/admitted', [ProductController::class, 'admittedList'])->name('products.admitted');



Route::get('/institutions/register', [InstitutionController::class, 'showRegisterForm'])->name('institutions.register');
Route::post('/institutions/reg/store', [InstitutionController::class, 'Registerstore'])->name('institutions.reg.store');


Route::get('/institutions/{institution_id}/faculties/{faculty_id}/courses/create', [CourseController::class, 'create']);
Route::get('/', [InstitutionController::class, 'userInstitutions'])->name('home');
Route::get('/institution/{id}/apply', [InstitutionController::class, 'apply'])->name('institution.apply');

Route::get('/faculties/log/{institution_id}', [FacultyController::class, 'log'])->name('faculties.log');
Route::get('/faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');



Route::get('/institutions/{institution}/faculties/add', [FacultyController::class, 'addFacultyForm'])->name('faculties.add');
Route::post('/institutions/{institution}/faculties/store', [FacultyController::class, 'storeByInstitution'])->name('institution.faculties.store');

Route::get('/institutions/{institution_id}/faculties/{faculty_id}/courses/create', [CourseController::class, 'create1']);
Route::get('/application-form/{faculty}', [ApplicationController::class, 'showApplicationForm']);





Route::post('/institutions/{institutionId}/faculties/{facultyId}/courses', [CourseController::class, 'store'])->name('courses.store');
Route::resource('institutions', InstitutionController::class);
Route::get('/institutions/{institution_id}/faculties', [FacultyController::class, 'index'])->name('faculties.index');
Route::get('/institutions/{institution_id}/faculties/create', [FacultyController::class, 'create'])->name('faculties.create');
Route::resource('faculties', FacultyController::class);
Route::get('/faculties/institution/{institutionId}', [FacultyController::class, 'index'])->name('faculties.index');
Route::get('/faculties/{institution_id}', [FacultyController::class, 'index']);
Route::get('/faculties/create/{institutionId}', [FacultyController::class, 'create'])->name('faculties.create');
Route::get('/institutions/{institutionId}/faculties', [FacultyController::class, 'index'])->name('faculties.index');
Route::prefix('institutions/{institution_id}')->group(function () {
    Route::resource('faculties', FacultyController::class);
});
Route::get('/institutions/{institutionId}/faculties/{facultyId}/courses/create', [CourseController::class, 'create'])
    ->name('faculties.courses.create');
Route::get('institutions/{institutionId}/faculties/{facultyId}/courses', [CourseController::class, 'index'])->name('faculties.courses.index');
Route::get('/institutions/{institutionId}/faculties/{facultyId}/courses/create', [CourseController::class, 'create'])->name('faculties.courses.create');
Route::get('institutions/{institutionId}/faculties', [FacultyController::class, 'index'])->name('faculties.index');
Route::get('institutions/{institutionId}/faculties/create', [FacultyController::class, 'create'])->name('faculties.create');
Route::post('institutions/{institutionId}/faculties', [FacultyController::class, 'store'])->name('faculties.store');
Route::get('institutions/{institutionId}/faculties/{id}/edit', [FacultyController::class, 'edit'])->name('faculties.edit');
Route::put('institutions/{institutionId}/faculties/{id}', [FacultyController::class, 'update'])->name('faculties.update');
Route::delete('institutions/{institutionId}/faculties/{id}', [FacultyController::class, 'destroy'])->name('faculties.destroy');
Route::get('/institutions/{institutionId}/faculties/{facultyId}/courses/create', [CourseController::class, 'create'])
    ->name('faculties.courses.create');

Route::get('/institutions/{institutionId}/faculties/{facultyId}/courses/log', [CourseController::class, 'log'])
    ->name('faculties.courses.log');

Route::prefix('institutions/{institutionId}/faculties/{facultyId}/courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('faculties.courses.index');
    Route::get('/by', [CourseController::class, 'indexby'])->name('faculties.courses.indexby');
    Route::get('/create', [CourseController::class, 'create'])->name('faculties.courses.create');
    Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/log', [CourseController::class, 'log'])->name('faculties.courses.log');
    Route::get('/addby', [CourseController::class, 'addby'])->name('faculties.courses.addby');
   
});


Route::post('/institutions/{institution_id}/faculties/{faculty_id}/store', [CourseController::class, 'storeByInstitution'])
    ->name('faculties.courses.storeByInstitution');


Route::get('/institutions/{institution_id}/faculties/{faculty_id}/add', [CourseController::class, 'log'])->name('courses.add');



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/institutions/{institution_id}/faculties/{faculty_id}/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/institutions/{institution_id}/faculties/{faculty_id}/courses', [CourseController::class, 'store'])->name('faculties.courses.store');




require __DIR__.'/auth.php';





//application

Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/create','create')->name('products.create');
    Route::post('/products','store')->name('products.store');
    Route::delete('/products/{product}','destroy')->name('products.destroy');    
});

Route::get('/institutions/{institution_id}/notifications', [ProductController::class, 'notifications'])->name('institutions.notifications');


Route::post('/notifications/mark-as-read', [ProductController::class, 'markAsRead'])->name('notifications.markAsRead');
