<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'institution_id'];

    public function faculty()
{
    return $this->belongsTo(Faculty::class);
}
public function institution()
{
    return $this->belongsTo(Institution::class);
}

}
