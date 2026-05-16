@extends('layouts.admin')

@section('header', 'Create Testimonial')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/testimonials/create.css') }}">
{{-- ── Page header ── --}}
<div class="page-header">
    <div>
        <div class="pf-eyebrow">Testimonials</div>
        <h2 class="pf-section-title">Create <em>Testimonial.</em></h2>
        <p class="pf-section-desc">Add a new client testimonial that will appear on the homepage.</p>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="pf-btn-ghost">
        <i class="fas fa-arrow-left"></i> Back to list
    </a>
</div>

<div class="pf-divider">
    <div class="pf-divider-line"></div>
    <div class="pf-divider-dot"></div>
    <div class="pf-divider-line"></div>
</div>

<div class="testimonial-builder">

    {{-- ── FORM ── --}}
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf

        <div class="grid-2 gap-24">
            <div class="form-group">
                <label for="client_name">Client Name</label>
                <input id="client_name" name="client_name" type="text" value="{{ old('client_name') }}" placeholder="Jane Doe" required>
            </div>
            <div class="form-group">
                <label for="client_company">Company</label>
                <input id="client_company" name="client_company" type="text" value="{{ old('client_company') }}" placeholder="Acme Corp">
            </div>
        </div>

        <div class="grid-2 gap-24">
            <div class="form-group">
                <label for="client_title">Title / Role</label>
                <input id="client_title" name="client_title" type="text" value="{{ old('client_title') }}" placeholder="Project Lead">
            </div>
            <div class="form-group">
                <label for="project_url">Project URL</label>
                <input id="project_url" name="project_url" type="url" value="{{ old('project_url') }}" placeholder="https://example.com">
            </div>
        </div>

        <div class="form-group">
            <label for="content">Testimonial Content</label>
            <textarea id="content" name="content" rows="6" placeholder="Write the client's testimonial here…" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-inner-divider"></div>

        <div class="grid-3 gap-24">
            <div class="form-group">
                <label for="rating">Rating (1–5)</label>
                <input id="rating" name="rating" type="number" min="1" max="5" value="{{ old('rating', 5) }}" required>
            </div>
            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input id="display_order" name="display_order" type="number" value="{{ old('display_order', 0) }}">
            </div>
            <div class="form-group">
                <label for="client_image">Client Image</label>
                <input id="client_image" name="client_image" type="file" accept="image/*">
            </div>
        </div>

        <div class="grid-2 gap-24">
            <div class="form-group form-group-checkbox">
                <label class="checkbox-label">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    Featured on homepage
                </label>
            </div>
            <div class="form-group form-group-checkbox">
                <label class="checkbox-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    Active
                </label>
            </div>
        </div>

        <div>
            <button type="submit" class="pf-btn-primary">
                <span><i class="fas fa-save" style="margin-right:6px;"></i>Save Testimonial</span>
            </button>
        </div>
    </form>


</div>
@endsection