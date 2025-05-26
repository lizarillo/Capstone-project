<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Make sure to import the User model

class AdminLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'login_time',
    ];

   public function admin()
{
    return $this->belongsTo(User::class, 'user_id'); // assuming 'user_id' ang foreign key
}

}
