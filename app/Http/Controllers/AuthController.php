<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    public function login(AuthUserRequest $request):JsonResponse
    {
        // Данные автоматически придут из body
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'user' => $user,
            'message' => 'Login successful'
        ]);
        /*$validated = $request->validated();
        if (!Auth::attempt($validated)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        $request->session()->regenerate();
        return response()->json();*/
    }
}
