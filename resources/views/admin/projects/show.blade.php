@extends('layouts.admin')

@section('header', 'View Project')
<link rel="stylesheet" href="{{ asset('css/admin/projects/show.css') }}">
@section('content')

<div class="pf-view-wrap">

    <a href="{{ route('admin.projects.index') }}" class="pf-back">
        <i class="fas fa-arrow-left"></i> Back to Projects
    </a>

    <div class="pf-eyebrow">View Entry</div>
    <h1 class="pf-page-title">View <em>Project</em></h1>

    <div class="pf-card">
        <div class="pf-content">

            <div class="pf-field">
                <label class="pf-label">Project Title</label>
                <div class="pf-value">{{ $project->title }}</div>
            </div>

            <div class="pf-field">
                <label class="pf-label">Slug</label>
                <div class="pf-value">{{ $project->slug }}</div>
            </div>

            <div class="pf-field">
                <label class="pf-label">Description</label>
                <div class="pf-value">{!! nl2br(e($project->description)) !!}</div>
            </div>

            @if($project->problem_solution)
            <div class="pf-field">
                <label class="pf-label">Problem &amp; Solution</label>
                <div class="pf-value">{!! nl2br(e($project->problem_solution)) !!}</div>
            </div>
            @endif

            <div class="pf-grid-2">
                <div class="pf-field">
                    <label class="pf-label">Project Image</label>
                    <div class="pf-value">
                        @if($project->image_url)
                            @if(str_starts_with($project->image_url, 'http'))
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" style="max-width: 100%; height: auto; border-radius: 8px;">
                            @else
                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" style="max-width: 100%; height: auto; border-radius: 8px;">
                            @endif
                        @else
                            <span style="color: var(--muted2);">No image uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="pf-field">
                    <label class="pf-label">Display Order</label>
                    <div class="pf-value">{{ $project->display_order ?? 'Not set' }}</div>
                </div>
            </div>

            <div class="pf-grid-2">
                <div class="pf-field">
                    <label class="pf-label">Live URL</label>
                    <div class="pf-value">
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" style="color: var(--accent2);">{{ $project->live_url }}</a>
                        @else
                            <span style="color: var(--muted2);">Not provided</span>
                        @endif
                    </div>
                </div>
                <div class="pf-field">
                    <label class="pf-label">GitHub URL</label>
                    <div class="pf-value">
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" style="color: var(--accent2);">{{ $project->github_url }}</a>
                        @else
                            <span style="color: var(--muted2);">Not provided</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($project->technologies)
            <div class="pf-field">
                <label class="pf-label">Technologies</label>
                <div class="pf-value">
                    @foreach($project->technologies as $tech)
                        <span style="display: inline-block; background: var(--surface2); padding: 4px 8px; border-radius: 6px; margin: 2px; font-size: 12px;">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if($project->role)
            <div class="pf-field">
                <label class="pf-label">Your Role</label>
                <div class="pf-value">{!! nl2br(e($project->role)) !!}</div>
            </div>
            @endif

            <div class="pf-divider">
                <div class="pf-divider-line"></div>
                <div class="pf-divider-dot"></div>
                <div class="pf-divider-line"></div>
            </div>

            <div class="pf-field">
                <div class="pf-subcard">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if($project->is_featured)
                            <span class="pf-featured-yes"><i class="fas fa-star"></i> Featured Project</span>
                        @else
                            <span class="pf-featured-no"><i class="fas fa-star"></i> Not Featured</span>
                        @endif
                    </div>
                    <div>
                        @if($project->is_active)
                            <span class="pf-status pf-status-active">Active</span>
                        @else
                            <span class="pf-status pf-status-inactive">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="pf-field">
                <label class="pf-label">Created At</label>
                <div class="pf-value">{{ $project->created_at->format('M d, Y \a\t H:i') }}</div>
            </div>

            <div class="pf-field">
                <label class="pf-label">Updated At</label>
                <div class="pf-value">{{ $project->updated_at->format('M d, Y \a\t H:i') }}</div>
            </div>

            <div class="pf-form-footer">
                <a href="{{ route('admin.projects.edit', $project) }}" class="pf-btn-primary">
                    <span><i class="fas fa-pen" style="margin-right:5px;"></i>Edit Project</span>
                </a>
                <a href="{{ route('admin.projects.index') }}" class="pf-btn-ghost">Back to List</a>
            </div>

        </div>
    </div>

</div>
@endsection