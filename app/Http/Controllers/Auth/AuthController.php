<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginUserRequest;
use App\Http\Requests\auth\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }
    public function register(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->all());
        $user->user_statuses()->create([
            'status_id' => 1
        ]);
        return redirect()->route('login');
    }
    public function showLoginForm(): View
    {
        return view('auth.login');
    }
    public function login(LoginUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if (!$user ||
            !$user->user_statuses ||
            $user->user_statuses->status_id !== 1) {
            return back()->withErrors([
                'email' => 'Access is denied: your profile is inactive.',
            ])->onlyInput('email');
        }

        if (!Auth::attempt($validated)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
