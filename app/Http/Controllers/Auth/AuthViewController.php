<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthViewController extends Controller
{
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }
}
