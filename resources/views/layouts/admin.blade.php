<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="flex min-h-screen">
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto bg-slate-950">
            <!-- Header -->
            <header class="border-b border-slate-800 bg-slate-900/95 sticky top-0 z-40 backdrop-blur">
                <div class="px-8 py-4 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">@yield('header', 'Admin Dashboard')</h2>
                        <p class="text-sm text-slate-400">Manage projects, services, inquiries, and account settings.</p>
                    </div>
                    @auth
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-md border border-slate-700 bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 transition">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </header>

            <!-- Content -->
            <main class="p-8">
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-900 text-green-300 border border-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-900 text-red-300 border border-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
