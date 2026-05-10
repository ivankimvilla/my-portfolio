<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')  Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        :root {
            --bg: #070b12;
            --surface: rgba(11, 15, 23, 0.94);
            --surface-soft: rgba(15, 23, 42, 0.92);
            --border: rgba(255, 255, 255, 0.08);
            --accent: #c8a96e;
            --accent-soft: rgba(200, 169, 110, 0.18);
            --text: #f8fafc;
            --muted: rgba(248, 250, 252, 0.68);
            --shadow: 0 32px 65px rgba(0, 0, 0, 0.2);
        }

        body.admin-shell {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text);
            background: radial-gradient(circle at 18% 16%, rgba(200, 169, 110, 0.08), transparent 22%),
                        radial-gradient(circle at 85% 20%, rgba(255, 255, 255, 0.04), transparent 18%),
                        linear-gradient(180deg, #07101a 0%, #05080e 100%);
        }

        .admin-layout {
            min-height: 100vh;
        }

        .admin-content {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            margin-left: calc(280px + 1.5rem);
        }

        .admin-header {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(10, 14, 22, 0.96);
            backdrop-filter: blur(18px);
            border-bottom: none;
            padding: 2rem 2rem 1.5rem;
        }

        .admin-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .admin-header-title {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .admin-header-title h2 {
            margin: 0;
            font-size: clamp(1.8rem, 2vw, 2.5rem);
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .admin-header-title p {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
            max-width: 640px;
        }

        .admin-action {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.95rem 1.25rem;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
            color: var(--text);
            transition: transform .2s ease, background .2s ease, border-color .2s ease;
        }

        .admin-action:hover {
            transform: translateY(-1px);
            background: rgba(200, 169, 110, 0.14);
            border-color: rgba(200, 169, 110, 0.24);
        }

        .admin-main {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
        }

        .admin-content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            gap: 1.5rem;
        }

        .admin-panel-card {
            background: rgba(11, 15, 23, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 28px;
            box-shadow: var(--shadow);
            overflow: hidden;
            backdrop-filter: blur(18px);
        }

        .admin-panel-card > .card-body {
            padding: 2rem;
        }

        .admin-alert {
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 22px 45px rgba(0, 0, 0, 0.16);
        }

        .admin-alert-success {
            border-color: transparent;
        }

        @media (max-width: 1024px) {
            .admin-layout {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .admin-content {
                margin-left: 0;
            }
        }

        @media (max-width: 720px) {
            .admin-header-inner {
                flex-direction: column;
                align-items: stretch;
            }

            .admin-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
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