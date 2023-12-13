<?php

use App\Actions\ImportContacts;
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

Route::get('/auth/redirect', function () {
    $scopes = [
        'https://www.googleapis.com/auth/userinfo.email',
        'https://www.googleapis.com/auth/userinfo.profile',
        'https://www.googleapis.com/auth/gmail.readonly',
        'https://www.googleapis.com/auth/contacts.readonly',
    ];

    return Socialite::driver('google')->scopes($scopes)->redirect();
});

Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    $user = User::updateOrCreate([
        'email' => $user->email,
    ], [
        'name' => $user->name,
        'google_id' => $user->id,
        'google_token' => $user->token,
        'google_refresh_token' => $user->refreshToken,
        'token_expires_at' => now()->addSeconds($user->expiresIn),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/contacts/import/google', function (GooglePeopleService $googlePeople, ImportContacts $importContacts) {
    $user = Auth::user();

    // check for expired token
    if(!$user->token_expires_at || $user->token_expires_at->isPast()) {
        $response = $googlePeople->refreshToken($user->google_refresh_token);
        $user->update([
            'google_token' => $response['access_token'],
            'token_expires_at' => now()->addSeconds($response['expires_in']),
        ]);
    }

    $googlePeople->setToken($user->google_token);

    $importContacts($googlePeople->contacts());

})->middleware(['auth'])->name('contacts.import.google');
