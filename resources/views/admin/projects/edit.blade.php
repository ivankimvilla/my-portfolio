@extends('layouts.admin')

@section('header', 'Edit Project')
<link rel="stylesheet" href="{{ asset('css/admin/projects/edit.css') }}">
@section('content')

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