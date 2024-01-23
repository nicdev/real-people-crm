<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        $action = 'authenticate';
        return view('login-register')->with(compact('action'));
    }

    public function register()
    {
        $action = 'auth.store';
        return view('login-register')->with(compact('action'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user, true);

        return redirect('/dashboard');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'email|required|string|max:255',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true)) {
            return redirect('/dashboard');
        }

        return redirect('/login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    public function googleRedirect()
    {
        $scopes = [
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/gmail.readonly',
            'https://www.googleapis.com/auth/contacts.readonly',
        ];

        return Socialite::driver('google')->scopes($scopes)->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'google_id' => $user->id,
            'google_token' => $user->token,
            'google_refresh_token' => $user->refreshToken,
            'token_expires_at' => now()->addSeconds($user->expiresIn),
            'photo' => $user->avatar,
        ]);

        Auth::login($user, true);

        return redirect('/');
    }

    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin-openid')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function linkedinCallback()
    {
        $user = Socialite::driver('linkedin-openid')->user();

        $user = User::updateOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'photo' => $user->avatar,
            'linkedin_token' => $user->token,
            'token_expires_at' => now()->addSeconds($user->expiresIn),
        ]);

        Auth::login($user, true);

        return redirect('/');
    }
}
