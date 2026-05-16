
<link rel="stylesheet" href="{{ asset('css/components/project-card.css') }}">

@props(['project'])

<a href="{{ route('portfolio.show', $project) }}" class="pf-project-card">

    {{-- Thumbnail --}}
    <div class="pf-project-thumb">
        @if($project->image_url)
            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
        @else
            <div class="pf-project-thumb-placeholder">
                <i class="fas fa-image"></i>
                <span>No project image</span>
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
                View Project <i class="fas fa-arrow-right"></i>
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