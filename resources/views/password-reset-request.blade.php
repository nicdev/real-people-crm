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
            @session('error-message')
                @include('shared.error', ['message' => session('error-message')])
            @endsession
            @session('message')
                @include('shared.success', ['message' => session('message')])
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
                action="{{ route('password.reset.init') }}"
                method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email"
                            class="sr-only">Email</label>
                        <input id="email"
                            name="email"
                            type="email"
                            required
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm rounded-md"
                            placeholder="you@email.com">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4  text-sm font-medium rounded-md shadow-sm bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white mr-2 border border-blue-500 hover:border-transparent">
                        Request Password Reset
                    </button>
                </div>
                <a href="{{ route('login') }}"
                    class="group relative w-full flex justify-center py-2 px-4  text-sm font-medium hover:bg-blue-500 text-blue-700 hover:text-white mr-2 rounded-md">
                    Return to Login</a>
            </form>
        </div>
    </div>
</body>
