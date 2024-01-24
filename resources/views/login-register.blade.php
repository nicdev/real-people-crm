<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta name="looking-at-component"
        content="app.blade.php">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>Real People CRM {{ isset($title) ? ' - ' . $title : '' }}</title>

    @vite('resources/css/app.css')
</head>

<body class="text-gray-800 font-sans flex items-center justify-center">
    <div class="container mx-auto p-4">
        <h1 class="max-w text-center text-6xl font-bold">Real People CRM</h1>
        <div class="flex justify-center mt-4">
            <img class="h-32 w-auto"
                src="{{ asset('images/logo.png') }}"
                alt="Real People CRM">
        </div>
        <div class="max-w-md w-full space-y-8 mx-auto">
            @session('message')
                @include('shared.error', ['message' => session('message')])
            @endsession
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ $error }}</span>
                    </div>
                @endforeach
            @endif
            <form class="mt-8 space-y-6"
                action="{{ route($action) }}"
                method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    @if ($action === 'auth.store')
                        <div>
                            <label for="name"
                                class="sr-only">Name</label>
                            <input id="name"
                                name="name"
                                type="text"
                                autocomplete="name"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Your Name">
                        </div>
                    @endif
                    <div>
                        <label for="email"
                            class="sr-only">Email address</label>
                        <input id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password"
                            class="sr-only">Password</label>
                        <input id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4  text-sm font-medium rounded-md shadow-sm bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white mr-2 border border-blue-500 hover:border-transparent">
                        {{ $action === 'authenticate' ? 'Sign in' : 'Register' }}
                    </button>
                </div>
            </form>
            <div class="flex w-full justify-between">
                <a href="/auth/linkedin/redirect"
                    class="inline-flex items-center gap-x-2 rounded-md px-2.5 py-2.5 text-sm font-medium shadow-sm bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white mr-2 border border-blue-500 hover:border-transparent w-half">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        height="36"
                        viewBox="0 0 72 72"
                        width="36">
                        <script xmlns="" />
                        <g fill="none"
                            fill-rule="evenodd">
                            <path
                                d="M8,72 L64,72 C68.418278,72 72,68.418278 72,64 L72,8 C72,3.581722 68.418278,-8.11624501e-16 64,0 L8,0 C3.581722,8.11624501e-16 -5.41083001e-16,3.581722 0,8 L0,64 C5.41083001e-16,68.418278 3.581722,72 8,72 Z"
                                fill="#007EBB" />
                            <path
                                d="M62,62 L51.315625,62 L51.315625,43.8021149 C51.315625,38.8127542 49.4197917,36.0245323 45.4707031,36.0245323 C41.1746094,36.0245323 38.9300781,38.9261103 38.9300781,43.8021149 L38.9300781,62 L28.6333333,62 L28.6333333,27.3333333 L38.9300781,27.3333333 L38.9300781,32.0029283 C38.9300781,32.0029283 42.0260417,26.2742151 49.3825521,26.2742151 C56.7356771,26.2742151 62,30.7644705 62,40.051212 L62,62 Z M16.349349,22.7940133 C12.8420573,22.7940133 10,19.9296567 10,16.3970067 C10,12.8643566 12.8420573,10 16.349349,10 C19.8566406,10 22.6970052,12.8643566 22.6970052,16.3970067 C22.6970052,19.9296567 19.8566406,22.7940133 16.349349,22.7940133 Z M11.0325521,62 L21.769401,62 L21.769401,27.3333333 L11.0325521,27.3333333 L11.0325521,62 Z"
                                fill="#FFF" />
                        </g>
                        <script xmlns="" />
                    </svg>
                    Sign In with LinkedIn
                </a>
                <a class="inline-flex items-center gap-x-2 rounded-md px-2.5 py-2.5 text-sm font-medium shadow-sm bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white mr-2 border border-blue-500 hover:border-transparent w-half"
                    href="/auth/google/redirect"><svg xmlns="http://www.w3.org/2000/svg"
                        height="36"
                        viewBox="0 0 24 24"
                        width="36">
                        <script xmlns="" />
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                        <path d="M1 1h22v22H1z"
                            fill="none" />
                        <script xmlns="" />
                    </svg>Sign in with Google</a>
            </div>
            @if ($action === 'authenticate')
                <div class="flex items-center justify-center">
                    <a href="{{ route('register') }}"
                        class="group relative w-1/2 flex justify-center py-2 px-4  text-sm font-medium hover:bg-blue-500 text-blue-700 hover:text-white mr-2 rounded-md text-center">
                        Don't have an account? Register</a>
                    <a href="{{ route('password.request') }}"
                        class="group relative w-1/2 flex justify-center py-2 px-4  text-sm font-medium hover:bg-blue-500 text-blue-700 hover:text-white mr-2 rounded-md text-center">
                        Forgot your password?</a>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="group relative w-full flex justify-center py-2 px-4  text-sm font-medium hover:bg-blue-500 text-blue-700 hover:text-white mr-2 rounded-md">
                    Already have an account? Login</a>
            @endif
        </div>
    </div>
</body>
