<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineRequest extends Model
{
      protected $fillable = ['requester_name', 'request_type', 'details'];
}
