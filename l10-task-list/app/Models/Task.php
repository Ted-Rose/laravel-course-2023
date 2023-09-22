<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    // By default mass assignment is disabled (setting values
    // for multiple values at one call - for security reasons
    // to prevent users from changing some hidden values
    // such as passwords)

    protected $fillable = [
        'title', 'description', 'long_description'
    ];

    // Guarded is oposite to fillable. If you have multiple values
    // at one call, you can use guarded to define the attributes that
    // should not be mass assigned. Meaning all the rest properties
    // can be mass assigned (not a safe practie)
    // protected $guarded = [
    //   'secret'
    // ];

    public function toggleComplete()
    {
      // Reversing tasks state
      $this->completed = !$this->completed;
      $this->save();
    }

// If you have slug property then it will use the slug
// to identify the model using the route model binding
//     public function getRouteKeyName()
//         /**
//      * Retrieves the name of the route key.
//      *
//      * @return string The name of the route key.
//      */
//     {
//         return 'slug';
//     }
}
