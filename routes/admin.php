<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware('auth', 'verified', 'admin')->group(function () {
    Route::get('users', [AdminController::class, 'index'])->name('admin.users.list');
    Route::get('{user}/profile', [UserProfileController::class, 'showUserProfile'])->name('admin.user.profile');
    Route::prefix('{user}/profile/update')->group(function () {
        Route::patch('name', [UserProfileController::class, 'updateUserProfileName'])->name('admin.user.update.name');
        Route::patch('email', [UserProfileController::class, 'updateUserProfileEmail'])->name('admin.user.update.email');
        Route::patch('password', [UserProfileController::class, 'updateUserProfilePassword'])->name('admin.user.update.password');
    });
    Route::prefix('{user}/profile')->group(function () {
        Route::post('recover', [UserProfileController::class, 'recoverUserProfile'])->name('admin.user.profile.recover');
        Route::delete('destroy', [UserProfileController::class, 'destroyUserProfile'])->name('admin.user.profile.destroy');
    });
    Route::prefix('/{user}/tasks')->group(function () {
        Route::get('/', [AdminController::class, 'userTasksList'])->name('admin.user.tasksList');
        Route::get('create', [AdminController::class, 'create'])->name('admin.task.create');
        Route::post('create', [AdminController::class, 'store'])->name('admin.task.store');
        Route::get('{slug}', [AdminController::class, 'show'])->name('admin.task.show');
        Route::get('{slug}/edit', [AdminController::class, 'edit'])->name('admin.task.edit');
        Route::patch('{slug}', [AdminController::class, 'update'])->name('admin.task.update');
        Route::delete('{slug}', [AdminController::class, 'destroy'])->name('admin.task.destroy');
    });
});
