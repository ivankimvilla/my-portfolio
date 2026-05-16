@extends('layouts.admin')

@section('header', 'Edit Testimonial')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/testimonials/edit.css') }}">
{{-- ── Page header ── --}}
<div class="page-header">
    <div>
        <div class="pf-eyebrow">Testimonials</div>
        <h2 class="pf-section-title">Edit <em>Testimonial.</em></h2>
        <p class="pf-section-desc">Update the details for {{ $testimonial->client_name }}'s testimonial.</p>
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
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <div class="grid-2 gap-24">
            <div class="form-group">
                <label for="client_name">Client Name</label>
                <input id="client_name" name="client_name" type="text" value="{{ old('client_name', $testimonial->client_name) }}" placeholder="Jane Doe" required>
            </div>
            <div class="form-group">
                <label for="client_company">Company</label>
                <input id="client_company" name="client_company" type="text" value="{{ old('client_company', $testimonial->client_company) }}" placeholder="Acme Corp">
            </div>
        </div>

        <div class="grid-2 gap-24">
            <div class="form-group">
                <label for="client_title">Title / Role</label>
                <input id="client_title" name="client_title" type="text" value="{{ old('client_title', $testimonial->client_title) }}" placeholder="Project Lead">
            </div>
            <div class="form-group">
                <label for="project_url">Project URL</label>
                <input id="project_url" name="project_url" type="url" value="{{ old('project_url', $testimonial->project_url) }}" placeholder="https://example.com">
            </div>
        </div>

        <div class="form-group">
            <label for="content">Testimonial Content</label>
            <textarea id="content" name="content" rows="6" placeholder="Write the client's testimonial here…" required>{{ old('content', $testimonial->content) }}</textarea>
        </div>

        <div class="form-inner-divider"></div>

        <div class="grid-3 gap-24">
            <div class="form-group">
                <label for="rating">Rating (1–5)</label>
                <input id="rating" name="rating" type="number" min="1" max="5" value="{{ old('rating', $testimonial->rating) }}" required>
            </div>
            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input id="display_order" name="display_order" type="number" value="{{ old('display_order', $testimonial->display_order) }}">
            </div>
            <div class="form-group">
                <label for="client_image">Client Image</label>
                <input id="client_image" name="client_image" type="file" accept="image/*">
                @if($testimonial->client_image)
                    <div class="current-image-badge">
                        <i class="fas fa-image"></i> Current image saved
                    </div>
                @endif
            </div>
        </div>

        <div class="grid-2 gap-24">
            <div class="form-group form-group-checkbox">
                <label class="checkbox-label">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>
                    Featured on homepage
                </label>
            </div>
            <div class="form-group form-group-checkbox">
                <label class="checkbox-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                    Active
                </label>
            </div>
        </div>

        <div>
            <button type="submit" class="pf-btn-primary">
                <span><i class="fas fa-save" style="margin-right:6px;"></i>Update Testimonial</span>
            </button>
        </div>
    </form>


</div>
@endsection