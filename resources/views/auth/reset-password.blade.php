@extends('layouts.admin-auth')

@section('title', 'Reset Password')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        font-family: 'Outfit', sans-serif;
        background: var(--bg);
        color: var(--text);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    :root {
        --bg:       #0b0c0e;
        --surface:  #111316;
        --surface2: #161820;
        --border:   rgba(255,255,255,.07);
        --accent:   #c8a96e;
        --accent2:  #e8c98a;
        --text:     #f0ece4;
        --muted:    rgba(240,236,228,.6);
        --muted2:   rgba(240,236,228,.22);
        --danger:   rgba(220,100,80,.85);
        --danger-bg: rgba(200,80,60,.08);
        --danger-border: rgba(200,80,60,.2);
    }

    /* ── PAGE WRAPPER ── */
    .rp-page {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 24px;
        position: relative;
    }

    /* Ambient background glow — mirrors the hero gradient */
    .rp-page::before {
        content: '';
        position: fixed; inset: 0;
        background:
            radial-gradient(ellipse 55% 45% at 8% 25%,  rgba(200,169,110,.07) 0%, transparent 60%),
            radial-gradient(ellipse 40% 55% at 88% 72%, rgba(200,169,110,.05) 0%, transparent 60%);
        pointer-events: none;
        z-index: 0;
    }

    /* Horizontal rule accent — mirrors .pf-hero-rule */
    .rp-page::after {
        content: '';
        position: fixed;
        top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent 0%, var(--accent) 50%, transparent 100%);
        opacity: .12;
        pointer-events: none;
        z-index: 0;
    }

    /* ── CARD ── */
    .rp-card {
        position: relative;
        width: 100%; max-width: 520px;
        background: var(--surface);
        border: 1px solid rgba(200,169,110,.18);
        border-radius: 20px;
        padding: 22px 40px;
        z-index: 1;
    }

    /* subtle inner top-border glow */
    .rp-card::before {
        content: '';
        position: absolute; top: 0; left: 20%; right: 20%; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(200,169,110,.4), transparent);
        border-radius: 99px;
    }

    @media (max-width: 600px) {
        .rp-card { padding: 20px 18px; }
    }

    /* ── HEADER ── */
    .rp-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent);
        margin-bottom: 8px;
    }
    .rp-eyebrow::before {
        content: ''; display: block;
        width: 24px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .rp-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 300; line-height: 1.08;
        letter-spacing: -1px;
        color: var(--text);
        margin: 0 0 4px;
    }
    .rp-title em { font-style: italic; color: var(--accent); }

    .rp-subtitle {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.5;
        margin-bottom: 16px;
    }

    /* divider */
    .rp-divider {
        display: flex; align-items: center; gap: 12px;
        margin-bottom: 12px;
    }
    .rp-divider-line { flex: 1; height: 1px; background: var(--border); }
    .rp-divider-dot {
        width: 4px; height: 4px; border-radius: 50%;
        background: var(--accent); opacity: .4;
    }

    /* ── ERROR BLOCK ── */
    .rp-errors {
        background: var(--danger-bg);
        border: 1px solid var(--danger-border);
        border-radius: 12px;
        padding: 16px 18px;
        margin-bottom: 28px;
        display: flex; gap: 12px; align-items: flex-start;
    }
    .rp-errors i { color: var(--danger); font-size: 13px; margin-top: 2px; flex-shrink: 0; }
    .rp-errors-title { font-size: 12px; font-weight: 600; color: var(--danger); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 1px; }
    .rp-errors ul { margin: 0; padding: 0 0 0 14px; }
    .rp-errors li { font-size: 13px; color: rgba(240,200,180,.75); line-height: 1.6; }

    /* ── FORM FIELDS ── */
    .rp-form { display: flex; flex-direction: column; gap: 10px; }

    .rp-field { display: flex; flex-direction: column; gap: 6px; }

    .rp-label {
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--muted);
        display: flex; align-items: center; gap: 7px;
    }
    .rp-label i { color: var(--accent); font-size: 10px; }

    .rp-input-wrap { position: relative; }

    .rp-input {
        width: 100%;
        padding: 10px 16px 10px 44px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        outline: none;
        transition: border-color .25s, box-shadow .25s;
        caret-color: var(--accent);
        -webkit-text-fill-color: var(--text);
    }
    .rp-input::placeholder { color: var(--muted2); }
    .rp-input:focus {
        border-color: rgba(200,169,110,.45);
        box-shadow: 0 0 0 3px rgba(200,169,110,.07);
        background: var(--surface2);
    }
    /* Kill browser autofill white/yellow override */
    .rp-input:-webkit-autofill,
    .rp-input:-webkit-autofill:hover,
    .rp-input:-webkit-autofill:focus,
    .rp-input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 999px var(--surface2) inset !important;
        box-shadow: 0 0 0 999px var(--surface2) inset !important;
        -webkit-text-fill-color: var(--text) !important;
        caret-color: var(--accent);
        border-color: rgba(200,169,110,.45);
    }

    /* password toggle has right padding */
    .rp-input.has-toggle { padding-right: 46px; }

    .rp-input-icon-left {
        position: absolute; left: 0; top: 0; bottom: 0;
        width: 44px;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent); font-size: 12px;
        pointer-events: none;
    }

    .rp-input-toggle {
        position: absolute; right: 0; top: 0; bottom: 0;
        width: 44px;
        display: flex; align-items: center; justify-content: center;
        background: none; border: none; cursor: pointer;
        color: var(--muted); font-size: 12px;
        transition: color .2s;
    }
    .rp-input-toggle:hover { color: var(--accent); }

    .rp-hint {
        font-size: 11px; color: var(--muted2);
        display: flex; align-items: center; gap: 6px;
        letter-spacing: .3px;
    }
    .rp-hint i { color: var(--accent); opacity: .6; font-size: 10px; }

    /* ── STRENGTH BAR ── */
    .rp-strength { display: flex; flex-direction: column; gap: 5px; }
    .rp-strength-header {
        display: flex; justify-content: space-between; align-items: center;
        font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px;
    }
    .rp-strength-label { color: var(--muted); font-weight: 600; }
    .rp-strength-text { color: var(--muted2); font-weight: 500; transition: color .3s; }

    .rp-strength-track {
        height: 2px;
        background: rgba(255,255,255,.07);
        border-radius: 99px;
        overflow: hidden;
    }
    .rp-strength-fill {
        height: 100%; width: 0%;
        border-radius: 99px;
        background: var(--accent);
        transition: width .35s ease, background .35s ease;
    }

    /* ── REQUIREMENTS ── */
    .rp-reqs {
        background: rgba(200,169,110,.04);
        border: 1px solid rgba(200,169,110,.12);
        border-radius: 12px;
        padding: 10px 16px;
    }
    .rp-reqs-title {
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        color: var(--accent); margin-bottom: 6px;
        display: flex; align-items: center; gap: 7px;
    }
    .rp-reqs-title::before {
        content: ''; display: block;
        width: 16px; height: 1px; background: var(--accent); opacity: .6;
    }
    .rp-reqs-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 4px;
    }
    @media (max-width: 440px) { .rp-reqs-grid { grid-template-columns: 1fr; } }

    .rp-req {
        display: flex; align-items: center; gap: 8px;
        font-size: 12px; color: var(--muted);
        transition: color .25s;
    }
    .rp-req i {
        font-size: 9px;
        color: rgba(255,255,255,.18);
        transition: color .25s, transform .2s;
        flex-shrink: 0;
        width: 14px; text-align: center;
    }
    .rp-req.met { color: var(--text); }
    .rp-req.met i { color: var(--accent); transform: scale(1.1); }

    /* ── SUBMIT BUTTON — mirrors .pf-btn-primary ── */
    .rp-submit {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%;
        padding: 11px 28px;
        background: transparent;
        border: 1px solid rgba(200,169,110,.5);
        border-radius: 10px;
        color: var(--accent2);
        font-family: 'Outfit', sans-serif;
        font-size: 12px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        cursor: pointer;
        position: relative; overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .15s;
    }
    .rp-submit::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .rp-submit:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 28px rgba(200,169,110,.16);
        transform: translateY(-1px);
    }
    .rp-submit:hover::before { opacity: 1; }
    .rp-submit span, .rp-submit i { position: relative; z-index: 1; }
    .rp-submit .arrow { transition: transform .2s; }
    .rp-submit:hover .arrow { transform: translateX(3px); }

    /* ── BACK LINK ── */
    .rp-footer {
        margin-top: 12px;
        padding-top: 10px;
        border-top: 1px solid var(--border);
        text-align: center;
    }
    .rp-back {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: 12px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--muted); text-decoration: none;
        transition: color .2s;
    }
    .rp-back i { transition: transform .2s; }
    .rp-back:hover { color: var(--accent); }
    .rp-back:hover i { transform: translateX(-3px); }
</style>

<div class="rp-page">
    <div class="rp-card">

        {{-- Header --}}
        <div class="rp-eyebrow">Security</div>
        <h1 class="rp-title">New <em>Password.</em></h1>
        <p class="rp-subtitle">Set a strong password to keep your account safe.</p>

        <div class="rp-divider">
            <div class="rp-divider-line"></div>
            <div class="rp-divider-dot"></div>
            <div class="rp-divider-line"></div>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="rp-errors">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <div class="rp-errors-title">Please fix the following</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.reset-password.perform') }}" class="rp-form">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email --}}
            <div class="rp-field">
                <label for="email" class="rp-label">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <div class="rp-input-wrap">
                    <span class="rp-input-icon-left"><i class="fas fa-envelope"></i></span>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $request->email) }}"
                        required autofocus
                        class="rp-input"
                        placeholder="admin@example.com"
                    >
                </div>
            </div>

            {{-- New Password --}}
            <div class="rp-field">
                <label for="password" class="rp-label">
                    <i class="fas fa-lock"></i> New Password
                </label>
                <div class="rp-input-wrap">
                    <span class="rp-input-icon-left"><i class="fas fa-lock"></i></span>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="rp-input has-toggle"
                        placeholder="••••••••"
                    >
                    <button type="button" class="rp-input-toggle" onclick="togglePassword('password', 'icon-password')" aria-label="Toggle password">
                        <i class="fas fa-eye" id="icon-password"></i>
                    </button>
                </div>
                <span class="rp-hint"><i class="fas fa-info-circle"></i> Minimum 8 characters</span>
            </div>

            {{-- Confirm Password --}}
            <div class="rp-field">
                <label for="password_confirmation" class="rp-label">
                    <i class="fas fa-shield-alt"></i> Confirm Password
                </label>
                <div class="rp-input-wrap">
                    <span class="rp-input-icon-left"><i class="fas fa-shield-alt"></i></span>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        class="rp-input has-toggle"
                        placeholder="••••••••"
                    >
                    <button type="button" class="rp-input-toggle" onclick="togglePassword('password_confirmation', 'icon-confirm')" aria-label="Toggle confirm password">
                        <i class="fas fa-eye" id="icon-confirm"></i>
                    </button>
                </div>
            </div>

            {{-- Strength Bar --}}
            <div class="rp-strength">
                <div class="rp-strength-header">
                    <span class="rp-strength-label">Strength</span>
                    <span class="rp-strength-text" id="strength-text">—</span>
                </div>
                <div class="rp-strength-track">
                    <div class="rp-strength-fill" id="strength-bar"></div>
                </div>
            </div>

            {{-- Requirements --}}
            <div class="rp-reqs">
                <div class="rp-reqs-title">Requirements</div>
                <div class="rp-reqs-grid">
                    <div class="rp-req" id="req-length">
                        <i class="fas fa-circle"></i><span>8+ characters</span>
                    </div>
                    <div class="rp-req" id="req-uppercase">
                        <i class="fas fa-circle"></i><span>Uppercase letter</span>
                    </div>
                    <div class="rp-req" id="req-lowercase">
                        <i class="fas fa-circle"></i><span>Lowercase letter</span>
                    </div>
                    <div class="rp-req" id="req-number">
                        <i class="fas fa-circle"></i><span>One number</span>
                    </div>
                    <div class="rp-req" id="req-match" style="grid-column: span 2;">
                        <i class="fas fa-circle"></i><span>Passwords match</span>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="rp-submit">
                <i class="fas fa-check"></i>
                <span>Reset Password</span>
                <i class="fas fa-arrow-right arrow"></i>
            </button>
        </form>

        {{-- Back --}}
        <div class="rp-footer">
            <a href="{{ route('admin.login') }}" class="rp-back">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
        </div>

    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

function checkStrength() {
    const pw  = document.getElementById('password').value;
    const cf  = document.getElementById('password_confirmation').value;
    const bar = document.getElementById('strength-bar');
    const txt = document.getElementById('strength-text');

    const checks = {
        length:    pw.length >= 8,
        uppercase: /[A-Z]/.test(pw),
        lowercase: /[a-z]/.test(pw),
        number:    /\d/.test(pw),
        match:     pw.length > 0 && pw === cf
    };

    const keys = ['length', 'uppercase', 'lowercase', 'number', 'match'];
    keys.forEach(k => {
        const el = document.getElementById('req-' + k);
        if (checks[k]) {
            el.classList.add('met');
            el.querySelector('i').className = 'fas fa-check-circle';
        } else {
            el.classList.remove('met');
            el.querySelector('i').className = 'fas fa-circle';
        }
    });

    const met = Object.values(checks).filter(Boolean).length;
    const pct = met * 20;
    bar.style.width = pct + '%';

    if (pct === 0) {
        bar.style.background = 'var(--accent)';
        txt.textContent = '—';
        txt.style.color = 'var(--muted2)';
    } else if (pct <= 40) {
        bar.style.background = '#b05040';
        txt.textContent = 'Weak';
        txt.style.color = '#b06050';
    } else if (pct <= 60) {
        bar.style.background = '#b08a30';
        txt.textContent = 'Fair';
        txt.style.color = '#c8a040';
    } else if (pct <= 80) {
        bar.style.background = 'var(--accent)';
        txt.textContent = 'Good';
        txt.style.color = 'var(--accent)';
    } else {
        bar.style.background = 'var(--accent2)';
        txt.textContent = 'Strong';
        txt.style.color = 'var(--accent2)';
    }
}

document.getElementById('password').addEventListener('input', checkStrength);
document.getElementById('password_confirmation').addEventListener('input', checkStrength);
</script>
@endsection