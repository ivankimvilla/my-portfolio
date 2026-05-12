@extends('layouts.admin')

@section('title', 'Admin Account')
@section('header', 'Admin Account Settings')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

    :root {
        --bg:       #0b0c0e;
        --surface:  #111316;
        --surface2: #161820;
        --border:   rgba(255,255,255,.07);
        --border2:  rgba(200,169,110,.25);
        --accent:   #c8a96e;
        --accent2:  #e8c98a;
        --text:     #f0ece4;
        --muted:    rgba(240,236,228,.65);
        --muted2:   rgba(240,236,228,.38);
        --danger:   rgba(239,68,68,.15);
        --danger-border: rgba(239,68,68,.35);
        --danger-text:   #fca5a5;
        --success:       rgba(34,197,94,.12);
        --success-border:rgba(34,197,94,.3);
        --success-text:  #86efac;
    }

    .profile-wrap {
        font-family: 'Outfit', sans-serif;
        max-width: 760px;
        margin: 0 auto;
    }

    /* EYEBROW */
    .pf-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 16px;
    }
    .pf-eyebrow::before {
        content: ''; display: block;
        width: 24px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    /* CARD */
    .pf-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,.35);
    }

    .pf-card::before {
        content: '';
        position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18;
    }

    .pf-card::after {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(200,169,110,.05), transparent 60%);
        pointer-events: none;
    }

    .pf-card-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 300;
        letter-spacing: -0.5px;
        color: var(--text);
        margin-bottom: 32px;
        position: relative; z-index: 1;
    }
    .pf-card-title em { font-style: italic; color: var(--accent); }

    /* ALERTS */
    .pf-alert {
        border-radius: 12px;
        padding: 16px 20px;
        font-size: 13px;
        margin-bottom: 28px;
        position: relative; z-index: 1;
    }

    .pf-alert-error {
        background: var(--danger);
        border: 1px solid var(--danger-border);
        color: var(--danger-text);
    }

    .pf-alert-success {
        background: var(--success);
        border: 1px solid var(--success-border);
        color: var(--success-text);
    }

    .pf-alert strong { font-weight: 600; }

    .pf-alert ul {
        margin-top: 10px;
        padding-left: 20px;
        display: flex; flex-direction: column; gap: 4px;
    }

    /* FORM */
    .pf-form { position: relative; z-index: 1; }

    .pf-form-group { margin-bottom: 24px; }

    .pf-label {
        display: block;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        color: var(--accent);
        margin-bottom: 10px;
    }

    /* Input wrapper for eye icon positioning */
    .pf-input-wrap {
        position: relative;
        margin-right: 4px;
    }

    .pf-input {
        width: 100%;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px 18px;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        color: var(--text);
        outline: none;
        transition: border-color .25s, box-shadow .25s;
        box-sizing: border-box;
    }

    /* Extra padding on right for password fields so text doesn't sit under icon */
    .pf-input.has-eye { padding-right: 48px; }

    .pf-input::placeholder { color: var(--muted2); }

    .pf-input:focus {
        border-color: var(--border2);
        box-shadow: 0 0 0 3px rgba(200,169,110,.08);
    }

    .pf-input-hint {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted2);
    }

    /* Eye toggle button */
    .pf-eye-btn {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--muted);
        font-size: 15px;
        padding: 4px;
        display: flex; align-items: center; justify-content: center;
        transition: color .2s;
        outline: none;
        line-height: 1;
    }
    .pf-eye-btn:hover { color: var(--accent); }

    /* PASSWORD SUB-CARD */
    .pf-subcard {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        position: relative; overflow: hidden;
    }

    .pf-subcard::before {
        content: '';
        position: absolute; top: 0; left: 20%; right: 20%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .12;
    }

    .pf-subcard-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 400;
        color: var(--text);
        margin-bottom: 24px;
    }
    .pf-subcard-title em { font-style: italic; color: var(--accent); }

    /* SUBMIT BUTTON */
    .pf-btn-primary {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 14px 28px;
        background: transparent;
        border: 1px solid rgba(200,169,110,.5);
        border-radius: 10px;
        color: var(--accent2);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        cursor: pointer;
        position: relative; overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .15s;
    }

    .pf-btn-primary::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }

    .pf-btn-primary:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.18);
        transform: translateY(-1px);
    }
    .pf-btn-primary:hover::before { opacity: 1; }
    .pf-btn-primary span { position: relative; z-index: 1; }

    .profile-wrap {
        font-family: 'Outfit', sans-serif;
        max-width: 760px;
        margin: 0 auto;
        padding-bottom: 40px;
    }
</style>

<div class="profile-wrap">

    <div class="pf-eyebrow">Account Settings</div>

    <div class="pf-card">
        <h3 class="pf-card-title">Update <em>Account</em></h3>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="pf-alert pf-alert-error">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="pf-alert pf-alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.profile.update') }}" class="pf-form">
            @csrf
            @method('PUT')

            <div class="pf-subcard">
                <h4 class="pf-subcard-title">Account Settings</h4>

                <div class="pf-form-group">
                    <label for="email" class="pf-label">Primary Email</label>
                    <div class="pf-input-wrap">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="pf-input"
                        />
                    </div>
                </div>

                <div class="pf-form-group">
                    <label for="recovery_email" class="pf-label">Recovery Email</label>
                    <div class="pf-input-wrap">
                        <input
                            type="email"
                            name="recovery_email"
                            id="recovery_email"
                            value="{{ old('recovery_email', $user->recovery_email) }}"
                            class="pf-input"
                        />
                    </div>
                    <p class="pf-input-hint">This email is used for account recovery.</p>
                </div>
            </div>

            <div class="pf-subcard">
                <h4 class="pf-subcard-title">Change <em>Password</em></h4>

                <div class="pf-form-group">
                    <label for="current_password" class="pf-label">Current Password</label>
                    <div class="pf-input-wrap">
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            class="pf-input has-eye"
                            placeholder="Enter current password"
                        />
                        <button type="button" class="pf-eye-btn" onclick="togglePassword('current_password', this)" tabindex="-1">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="pf-form-group">
                    <label for="password" class="pf-label">New Password</label>
                    <div class="pf-input-wrap">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="pf-input has-eye"
                            placeholder="Leave blank to keep current password"
                        />
                        <button type="button" class="pf-eye-btn" onclick="togglePassword('password', this)" tabindex="-1">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="pf-form-group" style="margin-bottom:0;">
                    <label for="password_confirmation" class="pf-label">Confirm New Password</label>
                    <div class="pf-input-wrap">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="pf-input has-eye"
                            placeholder="Repeat new password"
                        />
                        <button type="button" class="pf-eye-btn" onclick="togglePassword('password_confirmation', this)" tabindex="-1">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="pf-btn-primary">
                <span><i class="fas fa-save" style="margin-right:6px;"></i>Save Changes</span>
            </button>
        </form>
    </div>

</div>

<script>
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // No tab logic on the original account page.
    });
</script>

@endsection