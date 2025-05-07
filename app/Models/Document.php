<?php

namespace App\Models;

use App\Models\Institution;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\DocumentStatus;
use App\Enums\DocumentType;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'document_type',
        'first_name',
        'last_name',
        'email',
        'institution_id',
        'program_id',
        'course_id',
        'document_path',
        'status'
    ];

    protected $casts = [
        'document_type' => DocumentType::class,
        'status' => DocumentStatus::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
