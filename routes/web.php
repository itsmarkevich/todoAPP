<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/
/*Route::get('/', [MainController::class, 'index']);*/
Route::post('/user/reg', [AuthController::class, 'register'])->withoutMiddleware(ValidateCsrfToken::class);

/*Route::post('/user/reg', function ()
    {
        return "hate niggers";
    }
)->withoutMiddleware(ValidateCsrfToken::class);*/
/*Route::post('/user/log', [AuthController::class, 'login'])->withoutMiddleware(ValidateCsrfToken::class);*/











/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});*/
