<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user(); // gets the currently logged-in user
    
        return view('admin.dashboard', [
            'GetName' => $user->name,
            'GetEmail' => $user->email,
        ]);
    }
    
    
public function showAdminList()
{
    // Get users with the role 'admin'
    $user = User::where('role', 'admin')->get();
    return view('reports.admin', compact('user'));
}
    
public function showAdminDashboard()
{
    $GetName = 150; // Sample data (replace with real logic if needed)
    return view('admin.analytics', compact('GetName'));
}


    // Show Edit Profile Page
    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.profileEdit', compact('user'));
    }

    // Handle Profile Update
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'firstname'        => 'required|string|max:255',
            'lastname'         => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'profile_picture'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // View Profile
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
}
