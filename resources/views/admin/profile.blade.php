@extends('layouts.admin')

@section('title', 'Admin Account')
@section('header', 'Admin Account Settings')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6 rounded-lg border border-gray-800 bg-gray-900 p-6 shadow-lg">
        <h3 class="text-xl font-semibold text-white mb-4">Update Account</h3>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-700 bg-red-900/30 p-4 text-sm text-red-200">
                <strong class="font-semibold">Please fix the following:</strong>
                <ul class="mt-3 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 rounded-lg border border-green-700 bg-green-900/30 p-4 text-sm text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">Primary Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-3 text-white focus:border-blue-500 focus:outline-none" />
            </div>

            <div>
                <label for="recovery_email" class="block text-sm font-semibold text-gray-200 mb-2">Recovery Email</label>
                <input type="email" name="recovery_email" id="recovery_email" value="{{ old('recovery_email', $user->recovery_email) }}" class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-3 text-white focus:border-blue-500 focus:outline-none" />
                <p class="mt-2 text-sm text-gray-400">This email is used for account recovery.</p>
            </div>

            <div class="rounded-lg border border-gray-800 bg-gray-950 p-5">
                <h4 class="text-lg font-semibold text-white mb-4">Change Password</h4>

                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-semibold text-gray-200 mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-3 text-white focus:border-blue-500 focus:outline-none" placeholder="Enter current password" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">New Password</label>
                    <input type="password" name="password" id="password" class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-3 text-white focus:border-blue-500 focus:outline-none" placeholder="Leave blank to keep current password" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-200 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-3 text-white focus:border-blue-500 focus:outline-none" placeholder="Repeat new password" />
                </div>
            </div>

            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
                <i class="fas fa-save mr-2"></i>Save Changes
            </button>
        </form>
    </div>
</div>
@endsection
