<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    // Fillable columns for mass assignment
    protected $fillable = [
        'name',
        'code',
    ];

    // Optional: define relationships, for example programs
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
