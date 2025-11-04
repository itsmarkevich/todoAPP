<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showUserProfile'])->name('profile');
    Route::prefix('/profile/update')->group(function () {
        Route::patch('name', [ProfileController::class, 'updateProfileUserName'])->name('profile.update.name');
        Route::patch('email', [ProfileController::class, 'updateProfileUserEmail'])->name('profile.update.email');
        Route::patch('password', [ProfileController::class, 'updateProfileUserPassword'])->name('profile.update.password');
    });
    Route::delete('/profile/destroy', [ProfileController::class, 'destroyProfileUser'])->name('profile.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::prefix('/tasks')->group(function () {
        Route::get('create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('create', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('{slug}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('{slug}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::patch('{slug}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('{slug}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
