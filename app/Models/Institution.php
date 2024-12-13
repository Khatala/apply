<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Use Authenticatable base class
use Illuminate\Notifications\Notifiable;

class Institution extends Authenticatable  // Inherit from Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password', // Ensure this is included
    ];

    // Add any custom attributes or methods as needed
    public function products()
{
    return $this->hasMany(Product::class);
}

}
