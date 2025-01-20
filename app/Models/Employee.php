<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'job',
        'avatar',
        'documents', // Ensure this is included
        'status',
        'place_posted',
        'duration'
    ];

    /**
     * Get the user that owns the employee.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor for documents as an array.
     */
    public function getDocumentsArrayAttribute()
    {
        // Assuming documents are stored as a JSON array in the database
        return json_decode($this->documents, true) ?? [];
    }

    /**
     * Scope a query to only include pending employees.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include approved employees.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Accessor for formatted name.
     */
    public function getFormattedNameAttribute()
    {
        return ucwords($this->name);
    }

    /**
     * Accessor for the full phone number.
     */
    public function getFullPhoneNumberAttribute()
    {
        return $this->phone ? "+123-{$this->phone}" : null; // Example formatting
    }
}
