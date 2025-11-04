<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\UpdateUserEmailRequest;
use App\Http\Requests\auth\UpdateUserNameRequest;
use App\Http\Requests\auth\UpdateUserPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    public function showUserProfile(int $userId): View
    {
        $user = User::with('user_statuses')->findOrFail($userId);
        return view('admin.user_profile', ['user' => $user]);
    }

    public function updateUserProfileName(int $userId,UpdateUserNameRequest $request): RedirectResponse
    {
        $user = User::query()->findOrFail($userId);
        $user->name = $request->input('name');
        $user->save();
        return to_route('admin.user.profile', ['user' => $userId])->with('success', 'Name changed.');
    }

    public function updateUserProfileEmail(int $userId, UpdateUserEmailRequest $request): RedirectResponse
    {
        $user = User::query()->findOrFail($userId);
        $user->email = $request->input('email');
        $user->save();
        return to_route('admin.user.profile', ['user' => $userId])->with('success', 'Email changed.');
    }

    public function updateUserProfilePassword(int $userId, UpdateUserPasswordRequest $request): RedirectResponse
    {
        $user = User::query()->findOrFail($userId);
        $user->password = $request->input('password');
        $user->save();
        return to_route('admin.user.profile', ['user' => $userId])->with('success', 'Password changed.');
    }

    public function recoverUserProfile(int $userId): RedirectResponse
    {
        $user = User::with('user_statuses')->findOrFail($userId);
        $status = $user->user_statuses()->byUserId($userId)->first();
        $status->status_id = 1;
        $status->save();
        return to_route('admin.user.profile', ['user' => $userId]);
    }

    public function destroyUserProfile(int $userId): RedirectResponse
    {
        $user = User::query()->findOrFail($userId);
        $status = $user->user_statuses()->byUserId($userId)->first();
        $status->status_id = 0;
        $status->save();
        return to_route('admin.users.list');
    }
}
