@extends('layouts.admin-auth')

@section('title', 'Reset Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth/reset-password.css') }}">
<div class="rp-page">
    <div class="rp-card">

        <!-- Header -->
        <div class="rp-eyebrow">
            <i class="fas fa-lock-open"></i> Security
        </div>
        <h1 class="rp-title">Create New <em>Password</em></h1>
        <p class="rp-subtitle">Enter your new password below to regain access to your account.</p>

        <div class="rp-divider">
            <div class="rp-divider-line"></div>
            <div class="rp-divider-dot"></div>
            <div class="rp-divider-line"></div>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="rp-errors">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <div class="rp-errors-title">Error</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('admin.reset-password.perform') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="rp-field">
                <label for="email" class="rp-label">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
                    class="rp-input"
                    placeholder="admin@example.com"
                >
            </div>

            <!-- New Password -->
            <div class="rp-field">
                <label for="password" class="rp-label">
                    <i class="fas fa-lock"></i> New Password
                </label>
                <div class="rp-pw-wrap">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="rp-input"
                        placeholder="••••••••"
                    >
                    <button type="button" class="rp-eye" onclick="togglePw('password', this)" tabindex="-1" aria-label="Toggle password visibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <p class="rp-hint">Minimum 8 characters</p>
            </div>

            <!-- Confirm Password -->
            <div class="rp-field">
                <label for="password_confirmation" class="rp-label">
                    <i class="fas fa-lock"></i> Confirm Password
                </label>
                <div class="rp-pw-wrap">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        class="rp-input"
                        placeholder="••••••••"
                    >
                    <button type="button" class="rp-eye" onclick="togglePw('password_confirmation', this)" tabindex="-1" aria-label="Toggle password visibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Requirements info box -->
            <div class="rp-info">
                <strong><i class="fas fa-shield-alt" style="margin-right:6px;"></i>Requirements</strong>
                <ul>
                    <li>At least 8 characters</li>
                    <li>Mix of letters, numbers, and symbols recommended</li>
                    <li>Both passwords must match</li>
                </ul>
            </div>

            <!-- Submit -->
            <button type="submit" class="rp-btn">
                <span>
                    <i class="fas fa-check"></i>
                    Reset Password
                </span>
            </button>
        </form>

        <!-- Back link -->
        <div class="rp-back">
            <a href="{{ route('admin.login') }}">
                <i class="fas fa-arrow-left"></i>
                Back to Login
            </a>
        </div>

    </div>
</div>
@endsection

<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>