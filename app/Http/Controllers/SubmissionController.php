<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SubmissionController extends Controller
{
   public function listOfSubmission()
{
     return view('admin.submissions');
}

}
