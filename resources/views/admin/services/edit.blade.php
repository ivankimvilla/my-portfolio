@extends('layouts.admin')

@section('header', 'Edit Service')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

    :root {
        --bg:         #0b0c0e;
        --surface:    #111316;
        --surface2:   #161820;
        --border:     rgba(255,255,255,.07);
        --border2:    rgba(200,169,110,.25);
        --accent:     #c8a96e;
        --accent2:    #e8c98a;
        --text:       #f0ece4;
        --muted:      rgba(240,236,228,.55);
        --muted2:     rgba(240,236,228,.32);
        --red:        rgba(239,68,68,.12);
        --red-border: rgba(239,68,68,.3);
        --red-text:   #fca5a5;
    }

    .svc-form-wrap {
        font-family: 'Outfit', sans-serif;
        max-width: 760px;
        margin: 0 auto;
    }

    /* Back link */
    .svc-back {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 12px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--muted2); text-decoration: none;
        margin-bottom: 28px;
        transition: color .2s;
    }
    .svc-back:hover { color: var(--accent2); }
    .svc-back i { font-size: 10px; }

    /* Eyebrow */
    .svc-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 6px;
    }
    .svc-eyebrow::before {
        content: ''; display: block;
        width: 20px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .svc-page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px; font-weight: 300;
        letter-spacing: -0.5px; color: var(--text);
        margin-bottom: 28px;
    }
    .svc-page-title em { font-style: italic; color: var(--accent); }

    /* Card */
    .svc-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 40px;
        position: relative; overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,.35);
    }
    .svc-card::before {
        content: '';
        position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18;
    }
    .svc-card::after {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(200,169,110,.04), transparent 60%);
        pointer-events: none;
    }

    /* Form */
    .svc-form { position: relative; z-index: 1; }
    .svc-field { margin-bottom: 24px; }

    .svc-label {
        display: block;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        color: var(--accent); margin-bottom: 10px;
    }

    .svc-input,
    .svc-textarea {
        width: 100%;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 13px 16px;
        font-family: 'Outfit', sans-serif;
        font-size: 14px; color: var(--text);
        outline: none;
        box-sizing: border-box;
        transition: border-color .25s, box-shadow .25s;
        resize: vertical;
    }
    .svc-input::placeholder,
    .svc-textarea::placeholder { color: var(--muted2); }

    .svc-input:focus,
    .svc-textarea:focus {
        border-color: var(--border2);
        box-shadow: 0 0 0 3px rgba(200,169,110,.08);
    }

    .svc-input.has-error,
    .svc-textarea.has-error {
        border-color: var(--red-border);
        box-shadow: 0 0 0 3px var(--red);
    }

    .svc-error { font-size: 12px; color: var(--red-text); margin-top: 6px; }
    .svc-hint  { font-size: 12px; color: var(--muted2); margin-top: 6px; }

    /* Current certificate notice */
    .svc-cert-notice {
        display: inline-flex; align-items: center; gap: 8px;
        margin-top: 10px;
        padding: 8px 14px;
        background: rgba(200,169,110,.06);
        border: 1px solid rgba(200,169,110,.2);
        border-radius: 8px;
        font-size: 12px; color: var(--muted);
    }
    .svc-cert-notice a {
        color: var(--accent2);
        text-decoration: none;
        font-weight: 500;
        transition: opacity .2s;
    }
    .svc-cert-notice a:hover { opacity: .75; text-decoration: underline; }

    /* File input */
    .svc-file-input {
        width: 100%;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 13px 16px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px; color: var(--muted);
        box-sizing: border-box;
        cursor: pointer;
        transition: border-color .25s, box-shadow .25s;
    }
    .svc-file-input:focus {
        border-color: var(--border2);
        box-shadow: 0 0 0 3px rgba(200,169,110,.08);
        outline: none;
    }
    .svc-file-input::file-selector-button {
        font-family: 'Outfit', sans-serif;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.2px;
        padding: 6px 14px; margin-right: 14px;
        background: rgba(200,169,110,.1);
        border: 1px solid rgba(200,169,110,.3);
        border-radius: 7px;
        color: var(--accent2);
        cursor: pointer;
        transition: background .2s;
    }
    .svc-file-input::file-selector-button:hover {
        background: rgba(200,169,110,.18);
    }

    /* Grid */
    .svc-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 640px) { .svc-grid-2 { grid-template-columns: 1fr; } }

    /* Checkbox sub-card */
    .svc-subcard {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px 24px;
        display: flex; gap: 32px; flex-wrap: wrap;
    }

    .svc-checkbox-label {
        display: flex; align-items: center; gap: 10px;
        font-size: 13px; color: var(--muted);
        cursor: pointer;
    }

    .svc-checkbox {
        appearance: none; -webkit-appearance: none;
        width: 18px; height: 18px; flex-shrink: 0;
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 5px;
        cursor: pointer; position: relative;
        transition: background .2s, border-color .2s;
    }
    .svc-checkbox:checked {
        background: var(--accent);
        border-color: var(--accent);
    }
    .svc-checkbox:checked::after {
        content: '';
        position: absolute; top: 3px; left: 6px;
        width: 5px; height: 9px;
        border: 2px solid #0b0c0e;
        border-top: none; border-left: none;
        transform: rotate(45deg);
    }

    /* Divider */
    .svc-divider {
        display: flex; align-items: center; gap: 12px;
        margin: 8px 0 24px;
    }
    .svc-divider-line { flex: 1; height: 1px; background: var(--border); }
    .svc-divider-dot  { width: 4px; height: 4px; border-radius: 50%; background: var(--accent); opacity: .3; }

    /* Footer */
    .svc-form-footer {
        display: flex; gap: 12px; padding-top: 24px;
        border-top: 1px solid var(--border);
        margin-top: 8px;
    }

    .svc-btn-primary {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 13px 26px;
        background: transparent;
        border: 1px solid rgba(200,169,110,.5);
        border-radius: 10px; color: var(--accent2);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.5px;
        cursor: pointer; position: relative; overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .15s;
    }
    .svc-btn-primary::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .svc-btn-primary:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.15);
        transform: translateY(-1px);
    }
    .svc-btn-primary:hover::before { opacity: 1; }
    .svc-btn-primary span { position: relative; z-index: 1; }

    .svc-btn-ghost {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 13px 26px;
        border: 1px solid var(--border);
        border-radius: 10px; color: var(--muted);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        text-decoration: none;
        transition: border-color .25s, color .25s, transform .15s;
    }
    .svc-btn-ghost:hover {
        border-color: rgba(200,169,110,.3);
        color: var(--accent2);
        transform: translateY(-1px);
    }
</style>

<div class="svc-form-wrap">

    <a href="{{ route('admin.services.index') }}" class="svc-back">
        <i class="fas fa-arrow-left"></i> Back to Services
    </a>

    <div class="svc-eyebrow">Edit Entry</div>
    <h1 class="svc-page-title">Edit <em>Service</em></h1>

    <div class="svc-card">
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="svc-form">
            @csrf
            @method('PATCH')

            <div class="svc-field">
                <label for="title" class="svc-label">Service Title <span style="color:var(--accent);opacity:.6;">*</span></label>
                <input id="title" type="text" name="title" required
                    class="svc-input @error('title') has-error @enderror"
                    value="{{ old('title', $service->title) }}">
                @error('title')<p class="svc-error">{{ $message }}</p>@enderror
            </div>

            <div class="svc-field">
                <label for="slug" class="svc-label">Slug <span style="color:var(--accent);opacity:.6;">*</span></label>
                <input id="slug" type="text" name="slug" required
                    class="svc-input @error('slug') has-error @enderror"
                    value="{{ old('slug', $service->slug) }}">
                @error('slug')<p class="svc-error">{{ $message }}</p>@enderror
            </div>

            <div class="svc-field">
                <label for="description" class="svc-label">Description <span style="color:var(--accent);opacity:.6;">*</span></label>
                <textarea id="description" name="description" rows="4" required
                    class="svc-textarea @error('description') has-error @enderror">{{ old('description', $service->description) }}</textarea>
                @error('description')<p class="svc-error">{{ $message }}</p>@enderror
            </div>

            <div class="svc-grid-2">
                <div class="svc-field">
                    <label for="icon" class="svc-label">Icon <span style="color:var(--muted2);font-size:10px;">(emoji)</span></label>
                    <input id="icon" type="text" name="icon"
                        class="svc-input"
                        value="{{ old('icon', $service->icon) }}" maxlength="2">
                </div>
                <div class="svc-field">
                    <label for="price_range" class="svc-label">Price Range</label>
                    <input id="price_range" type="text" name="price_range"
                        class="svc-input"
                        value="{{ old('price_range', $service->price_range) }}">
                </div>
            </div>

            <div class="svc-field">
                <label for="deliverables" class="svc-label">Deliverables</label>
                <textarea id="deliverables" name="deliverables" rows="4"
                    class="svc-textarea">{{ old('deliverables', $service->deliverables ? implode("\n", $service->deliverables) : '') }}</textarea>
                <p class="svc-hint">One deliverable per line</p>
            </div>

            <div class="svc-field">
                <label for="tools" class="svc-label">Tools &amp; Technologies</label>
                <input id="tools" type="text" name="tools"
                    class="svc-input"
                    value="{{ old('tools', $service->tools ? implode(', ', $service->tools) : '') }}">
                <p class="svc-hint">Comma-separated — e.g., Laravel, React, MySQL</p>
            </div>

            <div class="svc-field">
                <label for="certificate" class="svc-label">Certificate <span style="color:var(--muted2);font-size:10px;">(PDF or image)</span></label>
                <input id="certificate" type="file" name="certificate" accept="application/pdf,image/jpeg,image/png"
                    class="svc-file-input">
                @error('certificate')<p class="svc-error">{{ $message }}</p>@enderror
                @if($service->certificate_url)
                    <div class="svc-cert-notice">
                        <i class="fas fa-file-alt" style="color:var(--accent);opacity:.6;"></i>
                        Current file on record —
                        <a href="{{ $service->certificate_url }}" target="_blank">
                            View certificate <i class="fas fa-external-link-alt" style="font-size:10px;"></i>
                        </a>
                    </div>
                @endif
                <p class="svc-hint">Upload a new file to replace the existing certificate (max 5MB)</p>
            </div>

            <div class="svc-field">
                <label for="display_order" class="svc-label">Display Order</label>
                <input id="display_order" type="number" name="display_order"
                    class="svc-input"
                    value="{{ old('display_order', $service->display_order) }}">
            </div>

            <div class="svc-divider">
                <div class="svc-divider-line"></div>
                <div class="svc-divider-dot"></div>
                <div class="svc-divider-line"></div>
            </div>

            <div class="svc-field">
                <div class="svc-subcard">
                    <label class="svc-checkbox-label">
                        <input type="checkbox" name="is_active" value="1" class="svc-checkbox" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                        <span><i class="fas fa-circle" style="color:#4ade80;font-size:8px;margin-right:5px;"></i>Active</span>
                    </label>
                </div>
            </div>

            <div class="svc-form-footer">
                <button type="submit" class="svc-btn-primary">
                    <span><i class="fas fa-save" style="margin-right:5px;"></i>Update Service</span>
                </button>
                <a href="{{ route('admin.services.index') }}" class="svc-btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</div>
@endsection