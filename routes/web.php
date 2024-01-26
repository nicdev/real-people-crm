<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Companies\Index as IndexCompany;
use App\Livewire\Companies\Show as ShowCompany;
use App\Livewire\Contacts\Index as IndexContact;
use App\Livewire\Contacts\Show as ShowContact;
use App\Livewire\Dashboard;
use App\Livewire\Settings\Index as IndexSettings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(Auth::check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/privacy-policy', function () {
    return view('privacy');
});;

Route::get('/tos', function () {
    return view('terms');
});;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/password/reset/request', [AuthController::class, 'passwordResetInit'])->name('password.reset.init');
Route::get('/password/reset/{resetToken}', [AuthController::class, 'passwordReset'])->name('password.reset');
Route::get('/password/reset', [AuthController::class, 'passwordResetRequest'])->name('password.request');
Route::post('/password/reset', [AuthController::class, 'updatePassword'])->name('auth.update');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/google/redirect', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');
Route::get('/auth/linkedin/redirect', [AuthController::class, 'linkedinRedirect'])->name('auth.linkedin.redirect');
Route::get('/auth/linkedin/callback', [AuthController::class, 'linkedinCallback'])->name('auth.linkedin.callback');

// Dashboard
Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');

// Settings
Route::get('/settings', IndexSettings::class)->middleware(['auth'])->name('settings');

// Contacts
Route::group(['prefix' => 'contacts', 'middleware' => 'auth'], function () {
    Route::get('/', IndexContact::class)->name('contacts.index');
    Route::get('/{contact:slug}', ShowContact::class)->name('contacts.show');
});

// Companies
Route::group(['prefix' => 'companies', 'middleware' => 'auth'], function () {
    Route::get('/', IndexCompany::class)->name('companies.index');
    Route::get('/{company:slug}', ShowCompany::class)->name('companies.show');
});
