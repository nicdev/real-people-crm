<?php

use App\Actions\Contacts\ImportContacts;
use App\Http\Controllers\AuthController;
use App\Livewire\Companies\Index as IndexCompany;
use App\Livewire\Companies\Show as ShowCompany;
use App\Livewire\Contacts\Index as IndexContact;
use App\Livewire\Contacts\Show as ShowContact;
use App\Livewire\Dashboard;
use App\Models\User;
use App\Services\GooglePeopleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/google/redirect', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');
Route::get('/auth/linkedin/redirect', [AuthController::class, 'linkedinRedirect'])->name('auth.linkedin.redirect');
Route::get('/auth/linkedin/callback', [AuthController::class, 'linkedinCallback'])->name('auth.linkedin.callback');

// Route::get('/contacts/import/google', function (GooglePeopleService $googlePeople, ImportContacts $importContacts) {
//     $user = Auth::user();

//     // check for expired token
//     if (! $user->token_expires_at || $user->token_expires_at->isPast()) {
//         $response = $googlePeople->refreshToken($user->google_refresh_token);
//         $user->update([
//             'google_token' => $response['access_token'],
//             'token_expires_at' => now()->addSeconds($response['expires_in']),
//         ]);
//     }

//     $googlePeople->setToken($user->google_token);

//     $importContacts($googlePeople->contacts());
// })->middleware(['auth'])->name('contacts.import.google');

// Dashboard
Route::get('/', Dashboard::class)->middleware(['auth'])->name('dashboard');

// Contacts
Route::group(['prefix' => 'contacts', 'middleware' => 'auth'], function () {
    Route::get('/', IndexContact::class)->name('contacts.index');
    Route::get('/{contact}', ShowContact::class)->name('contacts.show');
    Route::delete('/{contact}', function ($contact) {
        Auth::user()->contacts()->findOrFail($contact)->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    })->name('contacts.delete');
});

// Contact Events
Route::group(['prefix' => 'contact-events', 'middleware' => 'auth'], function () {
    Route::get('/', IndexContact::class)->name('contact-events.index');
    // Route::get('/{contact}', ShowContact::class)->name('contact-events.show');
    // Route::delete('/{contact}', function ($contact) {
    //     Auth::user()->contacts()->findOrFail($contact)->delete();

    //     session()->flash('message', 'Contact successfully deleted.');

    //     return redirect()->route('contact-events.index');
    // })->name('contact-events.delete');
});

// Companies
Route::group(['prefix' => 'companies', 'middleware' => 'auth'], function () {
    Route::get('/', IndexCompany::class)->name('companies.index');
    Route::get('/{company}', ShowCompany::class)->name('companies.show');

    Route::delete('/{company}', function ($company) {
        Auth::user()->companies()->findOrFail($company)->delete();

        session()->flash('message', 'Company successfully deleted.');

        return redirect()->route('companies.index');
    })->name('companies.delete');
});
