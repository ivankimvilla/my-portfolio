@extends('layouts.admin-auth')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-950 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-xl space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white">
                <i class="fas fa-lock-open text-blue-600 mr-2"></i>Create New Password
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Enter your new password below</p>
        </div>

        <!-- Card -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-800 p-8 space-y-6">

            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex gap-3">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">Error:</p>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.reset-password.perform') }}" class="space-y-6">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email Address
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                        placeholder="admin@example.com"
                    >
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>New Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                        placeholder="••••••••"
                    >
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Minimum 8 characters
                    </p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Confirm Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Password Strength Info -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3 text-xs text-blue-700 dark:text-blue-300">
                    <i class="fas fa-check-circle mr-2"></i>
                    <strong>Requirements:</strong>
                    <ul class="mt-2 list-disc list-inside space-y-1">
                        <li>At least 8 characters</li>
                        <li>Mix of letters, numbers, and symbols recommended</li>
                        <li>Passwords must match</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-check"></i>
                    Reset Password
                </button>
            </form>

            <!-- Links -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-800 text-center">
                <a href="{{ route('admin.login') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                    <i class="fas fa-arrow-left mr-1"></i>Back to Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
