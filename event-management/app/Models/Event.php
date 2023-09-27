<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    // HasFactory is an trait. Traits are always added to classes.
    // Synthax is "use TraitName"

    // Importing an trait to an model allows to use traits methods
    // without inheritence from a parent class

    protected $fillable = ['name', 'description', 'start_time', 'end_time', 'user_id'];

    // Return type is optional - BelongsTo
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }
}