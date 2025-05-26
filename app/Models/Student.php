<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'institution_id',
        'course',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
