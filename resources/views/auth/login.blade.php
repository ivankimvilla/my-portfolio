@extends('layouts.admin-auth')

@section('title', 'Portfolio Login')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
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
                <span class="pf-hero-eyebrow-text">Portfolio Studio</span>
            </div>

            <h2 class="pf-hero-title">
                Where ideas<br>
                become <em>craft.</em>
            </h2>

            <p class="pf-hero-desc">
                A curated space for design work, experiments, and the projects worth remembering. Manage your portfolio from here.
            </p>

            <div class="pf-thumbnails">
                <div class="pf-thumb pf-thumb-1" data-label="UI/UX">
                    <div class="pf-thumb-inner"></div>
                </div>
                <div class="pf-thumb pf-thumb-2" data-label="Brand">
                    <div class="pf-thumb-inner"></div>
                </div>
                <div class="pf-thumb pf-thumb-3" data-label="Web">
                    <div class="pf-thumb-inner"></div>
                </div>
                <div class="pf-thumb pf-thumb-4" data-label="Motion">
                    <div class="pf-thumb-inner"></div>
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

    {{-- RIGHT: LOGIN FORM --}}
    <div class="pf-right">
        <div class="pf-form-wrap">

            <div class="pf-form-tag">Secure Access</div>
            <h1 class="pf-form-title">Sign <em>in</em><br>to your portfolio.</h1>
            <p class="pf-form-sub">Enter your credentials to access your portfolio dashboard.</p>

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

            @if (session('success'))
                <div class="pf-alert pf-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.perform') }}">
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

                <div class="pf-field">
                    <label for="password" class="pf-field-label">Password</label>
                    <div class="pf-pw-wrap">
                        <input
                            type="password" name="password" id="password"
                            required
                            class="pf-field-input"
                            placeholder="••••••••••••"
                        >
                        <button type="button" class="pf-toggle-pw" onclick="togglePw()">
                            <i class="fas fa-eye" id="pwIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="pf-options">
                    <label class="pf-remember" for="remember">
                        <input type="checkbox" name="remember" id="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="pf-btn">
                    <span><i class="fas fa-arrow-right" style="margin-right:8px;"></i>Sign In</span>
                </button>
            </form>

            <div class="pf-forgot-wrap">
                <a href="{{ route('admin.forgot-password') }}" class="pf-forgot">
                    <i class="fas fa-key" style="font-size:11px;"></i>
                    Forgot your password?
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePw() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('pwIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

@endsection