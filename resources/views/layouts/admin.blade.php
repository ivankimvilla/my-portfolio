<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')  Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/admin.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
  
</head>
<body class="admin-shell">
    <div class="admin-layout">
        <x-admin-sidebar />

        <div class="admin-content">
            <header class="admin-header">
                <div class="admin-header-inner">
                    <div class="admin-header-title">
                        <h2>@yield('header', 'Admin Dashboard')</h2>
                        <p>Manage projects, services, certificates, inquiries, and account settings with a clean, modern workspace.</p>
                    </div>

                    @auth
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="admin-action">
                                <i class="fas fa-arrow-right-from-bracket"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    @endauth
                </div>
            </header>

            <main class="admin-main">
                <div class="admin-content-wrapper">
                    @if(session('success'))
                    <div class="admin-alert admin-alert-success p-4 bg-emerald-950/95 text-emerald-100">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="admin-alert p-4 bg-red-950/95 text-rose-100 border-rose-700/50">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="admin-panel-card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>