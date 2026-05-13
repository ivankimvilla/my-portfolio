@extends('layouts.admin')

@section('header', 'Edit Project')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

    :root {
        --bg:      #0b0c0e;
        --surface: #111316;
        --surface2:#161820;
        --border:  rgba(255,255,255,.07);
        --border2: rgba(200,169,110,.25);
        --accent:  #c8a96e;
        --accent2: #e8c98a;
        --text:    #f0ece4;
        --muted:   rgba(240,236,228,.55);
        --muted2:  rgba(240,236,228,.32);
        --red:     rgba(239,68,68,.12);
        --red-border: rgba(239,68,68,.3);
        --red-text:   #fca5a5;
    }

    .pf-form-wrap {
        font-family: 'Outfit', sans-serif;
        max-width: 760px;
        margin: 0 auto;
    }

    .pf-back {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 12px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--muted2); text-decoration: none;
        margin-bottom: 28px;
        transition: color .2s;
    }
    .pf-back:hover { color: var(--accent2); }
    .pf-back i { font-size: 10px; }

    .pf-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 6px;
    }
    .pf-eyebrow::before {
        content: ''; display: block;
        width: 20px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .pf-page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px; font-weight: 300;
        letter-spacing: -0.5px; color: var(--text);
        margin-bottom: 28px;
    }
    .pf-page-title em { font-style: italic; color: var(--accent); }

    .pf-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 40px;
        position: relative; overflow: hidden;
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
        background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(200,169,110,.04), transparent 60%);
        pointer-events: none;
    }

    .pf-form { position: relative; z-index: 1; }
    .pf-field { margin-bottom: 24px; }

    .pf-label {
        display: block;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        color: var(--accent); margin-bottom: 10px;
    }

    .pf-input,
    .pf-textarea {
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
    .pf-input::placeholder,
    .pf-textarea::placeholder { color: var(--muted2); }

    .pf-input:focus,
    .pf-textarea:focus {
        border-color: var(--border2);
        box-shadow: 0 0 0 3px rgba(200,169,110,.08);
    }

    .pf-input.has-error,
    .pf-textarea.has-error {
        border-color: var(--red-border);
        box-shadow: 0 0 0 3px var(--red);
    }

    .pf-error { font-size: 12px; color: var(--red-text); margin-top: 6px; }
    .pf-hint  { font-size: 12px; color: var(--muted2); margin-top: 6px; }

    .pf-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 640px) { .pf-grid-2 { grid-template-columns: 1fr; } }

    .pf-subcard {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px 24px;
        display: flex; gap: 32px; flex-wrap: wrap;
    }

    .pf-checkbox-label {
        display: flex; align-items: center; gap: 10px;
        font-size: 13px; color: var(--muted);
        cursor: pointer;
    }

    .pf-checkbox {
        appearance: none; -webkit-appearance: none;
        width: 18px; height: 18px; flex-shrink: 0;
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 5px;
        cursor: pointer; position: relative;
        transition: background .2s, border-color .2s;
    }
    .pf-checkbox:checked {
        background: var(--accent);
        border-color: var(--accent);
    }
    .pf-checkbox:checked::after {
        content: '';
        position: absolute; top: 3px; left: 6px;
        width: 5px; height: 9px;
        border: 2px solid #0b0c0e;
        border-top: none; border-left: none;
        transform: rotate(45deg);
    }

    .pf-divider {
        display: flex; align-items: center; gap: 12px;
        margin: 8px 0 24px;
    }
    .pf-divider-line { flex: 1; height: 1px; background: var(--border); }
    .pf-divider-dot  { width: 4px; height: 4px; border-radius: 50%; background: var(--accent); opacity: .3; }

    .pf-form-footer {
        display: flex; gap: 12px; padding-top: 24px;
        border-top: 1px solid var(--border);
        margin-top: 8px;
    }

    .pf-btn-primary {
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
    .pf-btn-primary::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .pf-btn-primary:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.15);
        transform: translateY(-1px);
    }
    .pf-btn-primary:hover::before { opacity: 1; }
    .pf-btn-primary span { position: relative; z-index: 1; }

    .pf-btn-ghost {
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
    .pf-btn-ghost:hover {
        border-color: rgba(200,169,110,.3);
        color: var(--accent2);
        transform: translateY(-1px);
    }
</style>

<div class="pf-form-wrap">

    <a href="{{ route('admin.projects.index') }}" class="pf-back">
        <i class="fas fa-arrow-left"></i> Back to Projects
    </a>

    <div class="pf-eyebrow">Edit Entry</div>
    <h1 class="pf-page-title">Edit <em>Project</em></h1>

    <div class="pf-card">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="pf-form" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="pf-field">
                <label for="title" class="pf-label">Project Title <span style="color:var(--accent);opacity:.6;">*</span></label>
                <input id="title" type="text" name="title" required
                    class="pf-input @error('title') has-error @enderror"
                    value="{{ old('title', $project->title) }}">
                @error('title')<p class="pf-error">{{ $message }}</p>@enderror
            </div>

            <div class="pf-field">
                <label for="slug" class="pf-label">Slug <span style="color:var(--accent);opacity:.6;">*</span></label>
                <input id="slug" type="text" name="slug" required
                    class="pf-input @error('slug') has-error @enderror"
                    value="{{ old('slug', $project->slug) }}">
                @error('slug')<p class="pf-error">{{ $message }}</p>@enderror
            </div>

            <div class="pf-field">
                <label for="description" class="pf-label">Description <span style="color:var(--accent);opacity:.6;">*</span></label>
                <textarea id="description" name="description" rows="4" required
                    class="pf-textarea @error('description') has-error @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')<p class="pf-error">{{ $message }}</p>@enderror
            </div>

            <div class="pf-field">
                <label for="problem_solution" class="pf-label">Problem &amp; Solution</label>
                <textarea id="problem_solution" name="problem_solution" rows="6"
                    class="pf-textarea">{{ old('problem_solution', $project->problem_solution) }}</textarea>
                <p class="pf-hint">Detailed explanation of the problem and your solution</p>
            </div>

            <div class="pf-grid-2">
                <div class="pf-field">
                    <label for="image_file" class="pf-label">Project Image</label>
                    <input id="image_file" type="file" name="image_file" accept="image/*"
                        class="pf-input">
                    @if($project->image_url)
                    <p class="pf-hint">Current image: <strong>{{ basename($project->image_url) }}</strong></p>
                    @endif
                    <p class="pf-hint">Upload a new image to replace the current one (JPEG, PNG, WebP; max 5MB)</p>
                </div>
                <div class="pf-field">
                    <label for="display_order" class="pf-label">Display Order</label>
                    <input id="display_order" type="number" name="display_order"
                        class="pf-input"
                        value="{{ old('display_order', $project->display_order) }}">
                </div>
            </div>

            <div class="pf-grid-2">
                <div class="pf-field">
                    <label for="live_url" class="pf-label">Live URL</label>
                    <input id="live_url" type="url" name="live_url"
                        class="pf-input"
                        value="{{ old('live_url', $project->live_url) }}">
                </div>
                <div class="pf-field">
                    <label for="github_url" class="pf-label">GitHub URL</label>
                    <input id="github_url" type="url" name="github_url"
                        class="pf-input"
                        value="{{ old('github_url', $project->github_url) }}">
                </div>
            </div>

            <div class="pf-field">
                <label for="technologies" class="pf-label">Technologies</label>
                <input id="technologies" type="text" name="technologies"
                    class="pf-input"
                    value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}"
                    placeholder="Laravel, Vue.js, MySQL">
                <p class="pf-hint">Comma-separated — e.g., Laravel, React, MySQL</p>
            </div>

            <div class="pf-field">
                <label for="role" class="pf-label">Your Role</label>
                <textarea id="role" name="role" rows="3"
                    class="pf-textarea">{{ old('role', $project->role) }}</textarea>
                <p class="pf-hint">What did you do on this project?</p>
            </div>

            <div class="pf-divider">
                <div class="pf-divider-line"></div>
                <div class="pf-divider-dot"></div>
                <div class="pf-divider-line"></div>
            </div>

            <div class="pf-field">
                <div class="pf-subcard">
                    <label class="pf-checkbox-label">
                        <input type="checkbox" name="is_featured" value="1" class="pf-checkbox" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                        <span><i class="fas fa-star" style="color:var(--accent);margin-right:5px;"></i>Featured Project</span>
                    </label>
                    <label class="pf-checkbox-label">
                        <input type="checkbox" name="is_active" value="1" class="pf-checkbox" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                        <span><i class="fas fa-circle" style="color:#4ade80;font-size:8px;margin-right:5px;"></i>Active</span>
                    </label>
                </div>
            </div>

            <div class="pf-form-footer">
                <button type="submit" class="pf-btn-primary">
                    <span><i class="fas fa-save" style="margin-right:5px;"></i>Update Project</span>
                </button>
                <a href="{{ route('admin.projects.index') }}" class="pf-btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</div>
@endsection