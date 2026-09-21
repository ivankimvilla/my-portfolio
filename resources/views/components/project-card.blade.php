
<link rel="stylesheet" href="{{ asset('css/components/project-card.css') }}">

@props(['project'])

@php
    $cardUrl = $project->live_url ?? route('portfolio.show', $project);
@endphp

<a href="{{ $cardUrl }}" class="pf-project-card" @if($project->live_url) target="_blank" rel="noopener noreferrer" @endif>

    {{-- Thumbnail --}}
    <div class="pf-project-thumb">
        @if($project->image_url)
            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
        @else
            <div class="pf-project-thumb-placeholder pc-image-no-image">
                <canvas class="pc-image-neural-canvas"></canvas>
                <span class="pc-neural-top-rule"></span>
                <span class="pc-neural-corner-bl"></span>
                <div class="pc-neural-label">
                    <span class="pc-neural-label-icon"><i class="fas fa-code"></i></span>
                    <span class="pc-neural-label-text">{{ $project->title }}</span>
                </div>
            </div>
        @endif
        <div class="pf-project-thumb-overlay"></div>
        @if($project->is_featured ?? false)
            <div class="pf-project-badge">
                <i class="fas fa-star" style="font-size:8px;"></i> Featured
            </div>
        @endif
    </div>

    {{-- Body --}}
    <div class="pf-project-body">
        <h3 class="pf-project-title">{{ $project->title }}</h3>
        <p class="pf-project-desc">{{ $project->description }}</p>

        @if($project->technologies && count($project->technologies))
        <div class="pf-project-tags">
            @foreach(array_slice($project->technologies, 0, 4) as $tech)
                <span class="pf-project-tag">{{ $tech }}</span>
            @endforeach
        </div>
        @endif

        <div class="pf-project-footer">
            <span class="pf-project-link">
                {{ $project->live_url ? 'View Demo' : 'View Work' }} <i class="fas fa-arrow-right"></i>
            </span>
            <div class="pf-project-ext-links">
                @if($project->live_url ?? false)
                <span class="pf-project-ext-link" title="Live Demo">
                    <i class="fas fa-external-link-alt"></i>
                </span>
                @endif
                @if($project->github_url ?? false)
                <span class="pf-project-ext-link" title="GitHub">
                    <i class="fab fa-github"></i>
                </span>
                @endif
            </div>
        </div>
    </div>

</a>