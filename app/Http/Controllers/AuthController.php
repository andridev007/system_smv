<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }
}
