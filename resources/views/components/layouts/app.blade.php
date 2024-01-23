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

<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="container mx-auto p-4">
        {{ $slot }}
    </div>
</body>

</html>
