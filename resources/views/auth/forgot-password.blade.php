@extends('layouts.admin-auth')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-950 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white">
                <i class="fas fa-shield-alt text-blue-600 mr-2"></i>Reset Password
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Enter your email to receive a password reset link</p>
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

            @if (session('status'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex gap-3">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5"></i>
                        <div>
                            <p class="text-sm text-green-700 dark:text-green-300">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.send-reset-link') }}" class="space-y-6">
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
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        We'll send you a password reset link to this email address.
                    </p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-paper-plane"></i>
                    Send Reset Link
                </button>
            </form>

            <!-- Links -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-800 space-y-2 text-center text-sm">
                <div>
                    <a href="{{ route('admin.login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Login
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.recovery') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        <i class="fas fa-redo mr-1"></i>Try Account Recovery
                    </a>
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 text-sm text-blue-700 dark:text-blue-300">
            <i class="fas fa-lightbulb mr-2"></i>
            <strong>Note:</strong> Check your email inbox for the password reset link. It may take a few moments to arrive.
        </div>
    </div>
</div>
@endsection
