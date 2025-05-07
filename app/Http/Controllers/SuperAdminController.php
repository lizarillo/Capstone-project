<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    // Show Dashboard
    public function showSuperAdmin()
    {
        return view('superadmin.dashboard');
    }

    // Show Admin Roles
    public function adminRoles()
    {
        return view('superadmin.adminroles');
    }

    // Show Student Submission
    public function studentSubmission()
    {
        return view('superadmin.studentSubmission');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('superadmin.updateAccount', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'profile_picture' => 'nullable|image|max:2048',
        ]);
    
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
    
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $user->profile_picture = $path;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    

}
