<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\UpdateUserEmailRequest;
use App\Http\Requests\auth\UpdateUserNameRequest;
use App\Http\Requests\auth\UpdateUserPasswordRequest;
use App\Models\UserStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function showUserProfile(): View
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateProfileUserName(UpdateUserNameRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();
        return redirect()->route('profile')->with('success', 'Name changed.');
    }

    public function updateProfileUserEmail(UpdateUserEmailRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('profile')->with('success', 'Email changed.');
    }

    public function updateProfileUserPassword(UpdateUserPasswordRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->password = $request->input('password');
        $user->save();
        return redirect()->route('profile')->with('success', 'Password changed.');
    }

    public function destroyProfileUser(): RedirectResponse
    {
        $user = Auth::user();
        $status = $user->user_statuses()->byUserId()->first();
        $status->status_id = 0;
        $status->save();
        Auth::logout();
        return redirect()->route('register');
    }
}
