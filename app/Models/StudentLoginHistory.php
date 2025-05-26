<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class StudentLoginHistory extends Model
{
    use HasFactory;

    protected $table = 'student_login_histories'; // explicitly set the table name

    protected $fillable = [
        'student_id',
        'login_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
