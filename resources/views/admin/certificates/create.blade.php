@extends('layouts.admin')

@section('header', 'Add New Certificate')

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

    .cert-form-wrap {
        font-family: 'Outfit', sans-serif;
        max-width: 760px;
        margin: 0 auto;
    }

    /* EYEBROW */
    .cert-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 16px;
    }
    .cert-eyebrow::before {
        content: ''; display: block;
        width: 24px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    /* CARD */
    .cert-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 8px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,.35);
    }

    .cert-card::before {
        content: '';
        position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18;
    }

    .cert-card::after {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(200,169,110,.05), transparent 60%);
        pointer-events: none;
    }

    .cert-card-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 300;
        letter-spacing: -0.5px;
        color: var(--text);
        margin-bottom: 32px;
        position: relative; z-index: 1;
    }
    .cert-card-title em { font-style: italic; color: var(--accent); }

    /* ALERTS */
    .cert-alert {
        border-radius: 12px;
        padding: 16px 20px;
        font-size: 13px;
        margin-bottom: 28px;
        position: relative; z-index: 1;
    }

    .cert-alert-error {
        background: var(--danger);
        border: 1px solid var(--danger-border);
        color: var(--danger-text);
    }

    .cert-alert-success {
        background: var(--success);
        border: 1px solid var(--success-border);
        color: var(--success-text);
    }

    .cert-alert strong { font-weight: 600; }

    .cert-alert ul {
        margin-top: 10px;
        padding-left: 20px;
        display: flex; flex-direction: column; gap: 4px;
    }

    /* FORM */
    .cert-form { position: relative; z-index: 1; }

    .cert-form-group { margin-bottom: 24px; }

    .cert-label {
        display: block;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        color: var(--accent);
        margin-bottom: 10px;
    }

    .cert-input {
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

    .cert-input::placeholder { color: var(--muted2); }

    .cert-input:focus {
        border-color: var(--border2);
        box-shadow: 0 0 0 3px rgba(200,169,110,.08);
    }

    .cert-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .cert-hint {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted2);
    }

    /* CHECKBOX */
    .cert-checkbox-wrap {
        display: flex; align-items: center; gap: 12px;
    }

    .cert-checkbox {
        width: 18px; height: 18px;
        accent-color: var(--accent);
    }

    .cert-checkbox-label {
        font-size: 14px;
        color: var(--muted);
    }

    /* BUTTONS */
    .cert-btns {
        display: flex; gap: 16px; justify-content: flex-end;
        margin-top: 40px;
    }

    .cert-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 14px 28px;
        border-radius: 12px;
        font-family: 'Outfit', sans-serif;
        font-size: 14px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1px;
        text-decoration: none;
        transition: transform .2s, background .2s, border-color .2s;
        cursor: pointer;
        border: none;
        outline: none;
    }

    .cert-btn-primary {
        background: var(--accent);
        color: #0b0c0e;
    }
    .cert-btn-primary:hover {
        background: var(--accent2);
        transform: translateY(-1px);
    }

    .cert-btn-secondary {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--muted);
    }
    .cert-btn-secondary:hover {
        border-color: var(--border2);
        background: rgba(200,169,110,.05);
        transform: translateY(-1px);
    }
</style>

<div class="cert-form-wrap">
    <div class="cert-eyebrow">Create</div>
    <h1 class="cert-card-title">Add New <em>Certificate</em></h1>

    @if($errors->any())
    <div class="cert-alert cert-alert-error">
        <strong>Please fix the following errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="cert-card">
        <form method="POST" action="{{ route('admin.certificates.store') }}" class="cert-form" enctype="multipart/form-data">
            @csrf

            <div class="cert-form-group">
                <label for="title" class="cert-label">Certificate Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="cert-input" placeholder="e.g., AWS Certified Solutions Architect" required>
                <div class="cert-hint">The name of the certificate</div>
            </div>

            <div class="cert-form-group">
                <label for="issuer" class="cert-label">Issuing Organization</label>
                <input type="text" id="issuer" name="issuer" value="{{ old('issuer') }}" class="cert-input" placeholder="e.g., Amazon Web Services" required>
                <div class="cert-hint">The organization that issued the certificate</div>
            </div>

            <div class="cert-form-group">
                <label for="issue_date" class="cert-label">Issue Date</label>
                <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" class="cert-input" required>
                <div class="cert-hint">When was this certificate issued?</div>
            </div>

            <div class="cert-form-group">
                <label for="description" class="cert-label">Description (Optional)</label>
                <textarea id="description" name="description" class="cert-input cert-textarea" placeholder="Brief description of the certificate...">{{ old('description') }}</textarea>
                <div class="cert-hint">Optional details about the certificate</div>
            </div>

            <div class="cert-form-group">
                <label for="certificate_file" class="cert-label">Certificate Image (Optional)</label>
                <input type="file" id="certificate_file" name="certificate_file" accept="image/*" class="cert-input">
                <div class="cert-hint">Upload the certificate image file (JPEG, PNG, WebP; max 5MB)</div>
            </div>

            <div class="cert-form-group">
                <div class="cert-checkbox-wrap">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="cert-checkbox">
                    <label for="is_active" class="cert-checkbox-label">Display this certificate on the website</label>
                </div>
            </div>

            <div class="cert-btns">
                <a href="{{ route('admin.certificates.index') }}" class="cert-btn cert-btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="cert-btn cert-btn-primary">
                    <i class="fas fa-save"></i> Create Certificate
                </button>
            </div>
        </form>
    </div>
</div>
@endsection