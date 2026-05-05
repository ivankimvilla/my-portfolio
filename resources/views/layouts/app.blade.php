<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My Portfolio</title>

    <!-- Font Awesome Icons (Professional Icon Library) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Professional Portfolio CSS (Pre-compiled) -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">

    <!-- Vite Assets (Optional - for when you set up npm) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <x-header />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
