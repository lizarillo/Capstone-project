<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'institution_id',
        // Add other fields here
    ];

    // ✅ Eloquent relationship
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
