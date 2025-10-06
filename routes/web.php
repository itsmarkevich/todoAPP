 <?php

use App\Http\Controllers\AuthController;
 use App\Http\Controllers\MainController;
 use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'index']);

Route::post('/user/reg', [AuthController::class, 'register']);

Route::get('/user/log',function ()
{
    return view('auth.login');
}
)->name('form.login');

Route::post('/user/log', [AuthController::class, 'login'])->name('auth.login');

/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});*/
