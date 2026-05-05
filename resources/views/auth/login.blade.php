@extends('layouts.admin-auth')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-950 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Logo -->
        <div class="text-center">
            <h1 class="text-4xl font-black tracking-tight">
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Portfolio</span>
            </h1>
            <h2 class="mt-6 text-3xl font-black text-gray-900 dark:text-white">Admin Login</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Access your portfolio management panel</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-800 p-8 space-y-6">

            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">Login failed:</p>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 dark:text-green-300">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.perform') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email Address
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                        placeholder="admin@example.com"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                    >
                    <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400 cursor-pointer">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>

            <!-- Help Links -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-800 space-y-3 text-center">
                <div>
                    <a href="{{ route('admin.forgot-password') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        <i class="fas fa-key mr-1"></i>Forgot Password?
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.recovery') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        <i class="fas fa-redo mr-1"></i>Account Recovery
                    </a>
                </div>
                <div>
                    <a href="/" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Portfolio
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="rounded-3xl border border-slate-800 bg-slate-900/80 p-4 text-sm text-slate-300 shadow-lg shadow-slate-950/30">
            <div class="flex items-start gap-3">
                <i class="fas fa-user-shield mt-1 text-blue-400"></i>
                <div>
                    <p class="font-semibold text-white">Admin access</p>
                    <p class="mt-1 text-slate-400">Use a registered admin email and password. If you have not created an admin account yet, run <code class="rounded bg-slate-800 px-1 py-0.5 text-xs">php artisan db:seed</code> to add one.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
