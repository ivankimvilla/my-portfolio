@extends('layouts.admin-auth')

@section('title', 'Account Recovery')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-950 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white">
                <i class="fas fa-life-ring text-blue-600 mr-2"></i>Account Recovery
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Recover your admin account using multiple methods</p>
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

            <form method="POST" action="{{ route('admin.send-recovery-link') }}" class="space-y-6">
                @csrf

                <!-- Recovery Method Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-shield-alt mr-2 text-blue-600"></i>Recovery Method
                    </label>
                    <div class="space-y-3">
                        <!-- Method 1: Email -->
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition recovery-method-label" data-method="email">
                            <input type="radio" name="recovery_method" value="email" checked class="w-4 h-4 text-blue-600 cursor-pointer">
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    <i class="fas fa-envelope mr-2 text-blue-600"></i>Primary Email
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Use your registered email address</p>
                            </div>
                        </label>

                        <!-- Method 2: Phone -->
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition recovery-method-label" data-method="phone">
                            <input type="radio" name="recovery_method" value="phone" class="w-4 h-4 text-blue-600 cursor-pointer">
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    <i class="fas fa-phone mr-2 text-purple-600"></i>Phone Number
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Use your registered phone number</p>
                            </div>
                        </label>

                        <!-- Method 3: Recovery Email -->
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition recovery-method-label" data-method="recovery_email">
                            <input type="radio" name="recovery_method" value="recovery_email" class="w-4 h-4 text-blue-600 cursor-pointer">
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    <i class="fas fa-at mr-2 text-pink-600"></i>Recovery Email
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Use your recovery email address</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Input Field -->
                <div>
                    <label for="recovery_value" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <span class="recovery-label">Email Address</span>
                    </label>
                    <input
                        type="text"
                        name="recovery_value"
                        id="recovery_value"
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                        placeholder="Enter your email"
                    >
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-paper-plane"></i>
                    Send Recovery Link
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
                    <a href="{{ route('admin.forgot-password') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        <i class="fas fa-key mr-1"></i>Forgot Password
                    </a>
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 text-sm text-blue-700 dark:text-blue-300 space-y-2">
            <p><i class="fas fa-info-circle mr-2"></i><strong>Account Recovery Methods:</strong></p>
            <ul class="list-disc list-inside space-y-1 ml-2">
                <li>Primary Email - Your main admin email address</li>
                <li>Phone - Your registered phone number (if set)</li>
                <li>Recovery Email - An alternate email for recovery (if set)</li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Update placeholder and label based on selected recovery method
    document.querySelectorAll('input[name="recovery_method"]').forEach(radio => {
        radio.addEventListener('change', function () {
            const method = this.value;
            const input = document.getElementById('recovery_value');
            const label = document.querySelector('.recovery-label');

            const placeholders = {
                email: 'Enter your primary email',
                phone: 'Enter your phone number',
                recovery_email: 'Enter your recovery email'
            };

            const labels = {
                email: 'Primary Email Address',
                phone: 'Phone Number',
                recovery_email: 'Recovery Email Address'
            };

            input.placeholder = placeholders[method];
            label.textContent = labels[method];
            input.focus();
        });
    });
</script>
@endsection
