@extends('layouts.admin')

@section('title', 'Admin Stats')
@section('header', 'Admin Stats Settings')

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
        padding-bottom: 40px;
    }

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

    .pf-card-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 300;
        letter-spacing: -0.5px;
        color: var(--text);
        margin-bottom: 32px;
        position: relative; z-index: 1;
    }
    .pf-card-title em { font-style: italic; color: var(--accent); }

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

    .pf-form-group { margin-bottom: 24px; }

    .pf-label {
        display: block;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        color: var(--accent);
        margin-bottom: 10px;
    }

    .pf-input-wrap { position: relative; margin-right: 4px; }

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

    .pf-input::placeholder { color: var(--muted2); }
    .pf-input:focus { border-color: var(--border2); box-shadow: 0 0 0 3px rgba(200,169,110,.08); }

    .pf-input-hint { margin-top: 8px; font-size: 12px; color: var(--muted2); }

    .pf-subcard {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        position: relative; overflow: hidden;
    }

    .pf-subcard-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 400;
        color: var(--text);
        margin-bottom: 24px;
    }
    .pf-subcard-title em { font-style: italic; color: var(--accent); }

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
    .pf-btn-primary::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06)); opacity: 0; transition: opacity .25s; }
    .pf-btn-primary:hover { border-color: var(--accent2); box-shadow: 0 0 24px rgba(200,169,110,.18); transform: translateY(-1px); }
    .pf-btn-primary:hover::before { opacity: 1; }
    .pf-btn-primary span { position: relative; z-index: 1; }
</style>

<div class="profile-wrap">
    <div class="pf-eyebrow">Account Stats</div>
    <div class="pf-card">
        <h3 class="pf-card-title">Update <em>Stats</em></h3>

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

        @if(session('success'))
            <div class="pf-alert pf-alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.profile.stats.update') }}" class="pf-form">
            @csrf
            @method('PUT')
            @method('PUT')

            <div class="pf-subcard">
                <h4 class="pf-subcard-title">Achievement <em>Stats</em></h4>
                @for ($i = 1; $i <= 3; $i++)
                    <div class="pf-form-group">
                        <label for="stat_{{ $i }}_number" class="pf-label">Stat {{ $i }} Number</label>
                        <input
                            type="text"
                            name="stat_{{ $i }}_number"
                            id="stat_{{ $i }}_number"
                            value="{{ old('stat_' . $i . '_number', data_get($user, 'stats.' . ($i - 1) . '.number')) }}"
                            class="pf-input"
                            placeholder="5+"
                        />
                    </div>

                    <div class="pf-form-group">
                        <label for="stat_{{ $i }}_label" class="pf-label">Stat {{ $i }} Label</label>
                        <input
                            type="text"
                            name="stat_{{ $i }}_label"
                            id="stat_{{ $i }}_label"
                            value="{{ old('stat_' . $i . '_label', data_get($user, 'stats.' . ($i - 1) . '.label')) }}"
                            class="pf-input"
                            placeholder="Years Experience"
                        />
                    </div>

                    <div class="pf-form-group">
                        <label for="stat_{{ $i }}_desc" class="pf-label">Stat {{ $i }} Description</label>
                        <input
                            type="text"
                            name="stat_{{ $i }}_desc"
                            id="stat_{{ $i }}_desc"
                            value="{{ old('stat_' . $i . '_desc', data_get($user, 'stats.' . ($i - 1) . '.desc')) }}"
                            class="pf-input"
                            placeholder="Building professional web solutions across industries."
                        />
                    </div>
                @endfor
            </div>

            <button type="submit" class="pf-btn-primary">
                <span><i class="fas fa-save" style="margin-right:6px;"></i>Save Changes</span>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // no extra JS needed for stats page
    });
</script>
@endsection