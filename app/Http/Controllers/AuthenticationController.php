<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    // Show login page
    public function showLoginPage()
    {
        return view('Authentication.login');
    }

    // Show registration page
    public function showRegistration()
    {
        return view('Authentication.register');
    }

    // Process registration (no email verification)
    public function processRegistration(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string|in:admin,superadmin',
        ]);

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('mylogin')->with('success', 'Registration successful! You can now login.');
    }



    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
    
            // Redirect based on role
            if ($user->role === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
    
        return back()->with('failed', 'Invalid email or password.');
    }
    


    
    
}
