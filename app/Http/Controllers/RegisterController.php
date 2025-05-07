<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function ShowMyloginpage()
    {
        return view('Login');
    }

    public function ShowRegistration(){
        return view('register');
    }

    
}