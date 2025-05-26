<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'status',
        'submitted_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
