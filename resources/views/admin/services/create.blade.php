@extends('layouts.admin')

@section('header', 'Create Service')
<link rel="stylesheet" href="{{ asset('css/admin/services/create.css') }}">
@section('content')

<div class="svc-form-wrap">

    <a href="{{ route('admin.services.index') }}" class="svc-back">
        <i class="fas fa-arrow-left"></i> Back to Services
    </a>

    <div class="svc-eyebrow">New Entry</div>
    <h1 class="svc-page-title">Create <em>Service</em></h1>

    <div class="svc-card">
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="svc-form">
            @csrf

            <div class="svc-field">
                <label for="title" class="svc-label">Service Title <span style="color:var(--accent);opacity:.6;">*</span></label>
                <input id="title" type="text" name="title" required
                    class="svc-input @error('title') has-error @enderror"
                    value="{{ old('title') }}" placeholder="Web Development">
                @error('title')<p class="svc-error">{{ $message }}</p>@enderror
            </div>

            <div class="svc-field">
                <label for="slug" class="svc-label">Slug <span style="color:var(--accent);opacity:.6;">*</span></label>
                <input id="slug" type="text" name="slug" required
                    class="svc-input @error('slug') has-error @enderror"
                    value="{{ old('slug') }}" placeholder="web-development">
                @error('slug')<p class="svc-error">{{ $message }}</p>@enderror
            </div>

            <div class="svc-field">
                <label for="description" class="svc-label">Description <span style="color:var(--accent);opacity:.6;">*</span></label>
                <textarea id="description" name="description" rows="4" required
                    class="svc-textarea @error('description') has-error @enderror"
                    placeholder="Brief service description...">{{ old('description') }}</textarea>
                @error('description')<p class="svc-error">{{ $message }}</p>@enderror
            </div>

            <div class="svc-grid-2">
                <div class="svc-field">
                    <label for="icon" class="svc-label">Icon <span style="color:var(--muted2);font-size:10px;">(emoji)</span></label>
                    <input id="icon" type="text" name="icon"
                        class="svc-input"
                        value="{{ old('icon') }}" placeholder="🚀" maxlength="2">
                </div>
                <div class="svc-field">
                    <label for="price_range" class="svc-label">Price Range</label>
                    <input id="price_range" type="text" name="price_range"
                        class="svc-input"
                        value="{{ old('price_range') }}" placeholder="$5,000 – $15,000">
                </div>
            </div>

            <div class="svc-field">
                <label for="deliverables" class="svc-label">Deliverables</label>
                <textarea id="deliverables" name="deliverables" rows="4"
                    class="svc-textarea"
                    placeholder="Design mockups&#10;Frontend development&#10;Backend API">{{ old('deliverables') }}</textarea>
                <p class="svc-hint">One deliverable per line</p>
            </div>

            <div class="svc-field">
                <label for="tools" class="svc-label">Tools &amp; Technologies</label>
                <textarea id="tools" name="tools" rows="3" class="svc-textarea" placeholder="Laravel, React, PostgreSQL, Tailwind, Docker
Vue.js, Alpine.js, Docker">{{ old('tools') }}</textarea>
                <p class="svc-hint">Separate tools with commas or new lines — unlimited skills are supported.</p>
            </div>

            <div class="svc-field">
                <label for="display_order" class="svc-label">Display Order</label>
                <input id="display_order" type="number" name="display_order"
                    class="svc-input"
                    value="{{ old('display_order', 0) }}">
            </div>

            <div class="svc-divider">
                <div class="svc-divider-line"></div>
                <div class="svc-divider-dot"></div>
                <div class="svc-divider-line"></div>
            </div>

            <div class="svc-field">
                <div class="svc-subcard">
                    <label class="svc-checkbox-label">
                        <input type="checkbox" name="is_active" value="1" class="svc-checkbox" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span><i class="fas fa-circle" style="color:#4ade80;font-size:8px;margin-right:5px;"></i>Active</span>
                    </label>
                </div>
            </div>

            <div class="svc-form-footer">
                <button type="submit" class="svc-btn-primary">
                    <span><i class="fas fa-plus" style="margin-right:5px;"></i>Create Service</span>
                </button>
                <a href="{{ route('admin.services.index') }}" class="svc-btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</div>
@endsection