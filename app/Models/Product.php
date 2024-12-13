<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mother_name',
        'father_name',
        'address',
        'gender',
        'course_name',
        'district',
        'dob',
        'email',
        'results',
        'status',
        'institution_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
        'status' => 'string',
    ];

    /**
     * Get the institution that owns the product.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
