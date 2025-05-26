<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Show the form to request a password reset link
    public function showLinkRequestForm()
    {
        // Use lowercase folder name 'authentication' for convention
        return view('authentication.email'); // Make sure your blade is at resources/views/authentication/email.blade.php
    }

    // Handle sending the password reset link email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Attempt to send the password reset link to the given email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the response and redirect accordingly
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['success' => __($status)]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
