<?php

use App\Actions\Contacts\ImportContacts;
use App\Livewire\Companies\Index as IndexCompany;
use App\Livewire\Contacts\Create as CreateContact;
use App\Livewire\Contacts\Index as IndexContact;
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

Route::get('/login', function () {
    return view('login');
})->name('login');

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
    if (!$user->token_expires_at || $user->token_expires_at->isPast()) {
        $response = $googlePeople->refreshToken($user->google_refresh_token);
        $user->update([
            'google_token' => $response['access_token'],
            'token_expires_at' => now()->addSeconds($response['expires_in']),
        ]);
    }

    $googlePeople->setToken($user->google_token);

    $importContacts($googlePeople->contacts());
})->middleware(['auth'])->name('contacts.import.google');

// Contacts
Route::group(['prefix' => 'contacts', 'middleware' => 'auth'], function () {
    Route::get('/', IndexContact::class)->name('contacts.index');
    
    Route::get('/{contact}', function ($contact) {
        return view('contacts.show', [
            'contact' => Auth::user()->contacts()->findOrFail($contact),
        ]);

    })->name('contacts.show');
    
    Route::delete('/{contact}', function ($contact) {
        Auth::user()->contacts()->findOrFail($contact)->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    })->name('contacts.delete');
});

// Companmies
Route::group(['prefix' => 'companies', 'middleware' => 'auth'], function () {
    Route::get('/', IndexCompany::class)->name('companies.index');
    
    Route::get('/{company}', function ($company) {
        return view('companies.show', [
            'company' => Auth::user()->companies()->findOrFail($company),
        ]);
        
    })->name('company.show');
});
