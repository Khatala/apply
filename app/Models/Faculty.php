<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $table = 'faculties';

    protected $fillable = [
        'name',
        'faculty_code',
        'sponsor_type',
        'institution_id', // Ensure this is fillable if it's part of the form
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function courses()
{
    return $this->hasMany(Course::class);
}


}
