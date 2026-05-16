@extends('layouts.admin-auth')

@section('title', 'Reset Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth/forgot-password.css') }}">
<div class="pf-login">

    {{-- LEFT: PORTFOLIO IDENTITY --}}
    <div class="pf-left">
        <div class="pf-rule pf-rule-top"></div>
        <div class="pf-rule pf-rule-bottom"></div>
        <div class="pf-vline"></div>

        <div class="pf-left-content pf-brand">
            <div class="pf-brand-monogram">IKA</div>
            <div>
                <div class="pf-brand-name">Ivan Kim Almadin</div>
                <div class="pf-brand-role">Creative Portfolio</div>
            </div>
        </div>

        <div class="pf-left-content pf-hero">
            <div class="pf-hero-eyebrow">
                <span class="pf-hero-eyebrow-line"></span>
                <span class="pf-hero-eyebrow-text">Account Recovery</span>
            </div>

            <h2 class="pf-hero-title">
                Locked<br>
                out? No<br>
                <em>worries.</em>
            </h2>

            <p class="pf-hero-desc">
                We'll send a secure reset link straight to your inbox. Back in your studio in minutes.
            </p>

            <div class="pf-deco-icon">
                <div class="pf-deco-icon-circle">
                    <i class="fas fa-key"></i>
                </div>
                <div class="pf-deco-steps">
                    <div class="pf-deco-step">
                        <div class="pf-deco-step-num">1</div>
                        <span>Enter your email address</span>
                    </div>
                    <div class="pf-deco-step">
                        <div class="pf-deco-step-num">2</div>
                        <span>Check your inbox for the link</span>
                    </div>
                    <div class="pf-deco-step">
                        <div class="pf-deco-step-num">3</div>
                        <span>Create a new password &amp; sign in</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="pf-left-footer pf-left-content">
            <span class="pf-left-footer-copy">&copy; {{ date('Y') }} Ivan Kim Almadin. All rights reserved.</span>
            <div class="pf-social-dots">
                <div class="pf-social-dot"></div>
                <div class="pf-social-dot"></div>
                <div class="pf-social-dot"></div>
            </div>
        </div>
    </div>

    {{-- RIGHT: FORM --}}
    <div class="pf-right">
        <div class="pf-form-wrap">

            <div class="pf-form-tag">Account Recovery</div>
            <h1 class="pf-form-title">Reset your<br><em>password.</em></h1>
            <p class="pf-form-sub">Enter the email tied to your portfolio account and we'll send you a reset link.</p>

            <div class="pf-form-divider">
                <div class="pf-form-divider-line"></div>
                <div class="pf-form-divider-dot"></div>
                <div class="pf-form-divider-line"></div>
            </div>

            @if ($errors->any())
                <div class="pf-alert pf-alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <div style="font-weight:500; margin-bottom:4px;">Please correct the following:</div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="pf-alert pf-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.send-reset-link') }}">
                @csrf

                <div class="pf-field">
                    <label for="email" class="pf-field-label">Email Address</label>
                    <input
                        type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        required autofocus
                        class="pf-field-input"
                        placeholder="you@example.com"
                    >
                </div>

                <p class="pf-field-hint">
                    <i class="fas fa-info-circle" style="margin-right:5px; color:var(--accent); opacity:.7;"></i>
                    We'll send a password reset link to this address.
                </p>

                <button type="submit" class="pf-btn">
                    <span><i class="fas fa-paper-plane" style="margin-right:8px;"></i>Send Reset Link</span>
                </button>
            </form>

            <div class="pf-back-wrap">
                <a href="{{ route('admin.login') }}" class="pf-back">
                    <i class="fas fa-arrow-left" style="font-size:11px;"></i>
                    Back to login
                </a>
            </div>

        </div>
    </div>
</div>

@endsection