<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'mother_name', 'father_name', 
        'address', 'gender', 'course_id', 'faculty_id', 'district', 
        'dob', 'email', 'results_file', 'status','institution_id'
    ];
    

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}

