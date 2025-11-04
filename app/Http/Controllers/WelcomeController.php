<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function welcome(): View
    {
        return view('welcome');
    }
}
