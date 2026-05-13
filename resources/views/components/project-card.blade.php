@props(['project'])

<a href="{{ route('portfolio.show', $project) }}" class="pf-project-card">

    {{-- Thumbnail --}}
    <div class="pf-project-thumb">
        @if($project->image_url)
            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
        @else
            <div class="pf-project-thumb-placeholder">
                <i class="fas fa-image"></i>
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

<style>
    .pf-project-card {
        background: var(--surface, #111316);
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 20px;
        overflow: hidden;
        display: flex; flex-direction: column;
        position: relative;
        text-decoration: none; color: inherit;
        transition: border-color .3s, transform .3s, box-shadow .3s;
    }
    .pf-project-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, #c8a96e, transparent);
        opacity: 0; transition: opacity .3s;
        pointer-events: none; z-index: 2;
    }
    .pf-project-card:hover {
        border-color: rgba(200,169,110,.28);
        transform: translateY(-5px);
        box-shadow: 0 24px 48px rgba(0,0,0,.35), 0 0 0 1px rgba(200,169,110,.06);
    }
    .pf-project-card:hover::before { opacity: 1; }

    /* Thumbnail */
    .pf-project-thumb {
        position: relative;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #161820;
    }
    .pf-project-thumb img {
        width: 100%; height: 100%;
        object-fit: cover; display: block;
        transition: transform .5s ease;
    }
    .pf-project-card:hover .pf-project-thumb img { transform: scale(1.05); }

    .pf-project-thumb-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #111316 0%, #161820 100%);
    }
    .pf-project-thumb-placeholder i { font-size: 36px; color: #c8a96e; opacity: .2; }

    .pf-project-thumb-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,.6) 100%);
        opacity: 0; transition: opacity .3s;
        pointer-events: none;
    }
    .pf-project-card:hover .pf-project-thumb-overlay { opacity: 1; }

    .pf-project-badge {
        position: absolute; top: 14px; left: 14px;
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 9px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: #c8a96e;
        border: 1px solid rgba(200,169,110,.35);
        background: rgba(11,12,14,.82);
        backdrop-filter: blur(8px);
        border-radius: 99px; padding: 5px 10px;
        z-index: 3;
    }

    /* Body */
    .pf-project-body {
        padding: 26px 26px 20px;
        display: flex; flex-direction: column;
        flex: 1;
        font-family: 'Outfit', sans-serif;
    }

    .pf-project-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px; font-weight: 400;
        line-height: 1.2; letter-spacing: -0.3px;
        color: #f0ece4; margin-bottom: 10px;
        transition: color .2s;
    }
    .pf-project-card:hover .pf-project-title { color: #e8c98a; }

    .pf-project-desc {
        font-size: 13px; color: rgba(240,236,228,.65);
        line-height: 1.75; margin-bottom: 20px;
        flex: 1;
        text-align: justify;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pf-project-tags {
        display: flex; flex-wrap: wrap; gap: 7px;
        margin-bottom: 22px;
    }
    .pf-project-tag {
        font-size: 11px; font-weight: 500;
        color: #c8a96e;
        border: 1px solid rgba(200,169,110,.2);
        background: rgba(200,169,110,.06);
        padding: 4px 10px; border-radius: 6px;
        transition: border-color .2s, background .2s;
    }
    .pf-project-card:hover .pf-project-tag {
        border-color: rgba(200,169,110,.35);
        background: rgba(200,169,110,.1);
    }

    .pf-project-footer {
        border-top: 1px solid rgba(255,255,255,.07);
        padding-top: 18px;
        display: flex; align-items: center;
        justify-content: space-between;
    }

    .pf-project-link {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: 12px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: #c8a96e;
        transition: gap .2s, color .2s;
    }
    .pf-project-card:hover .pf-project-link { gap: 11px; color: #e8c98a; }
    .pf-project-link i { font-size: 11px; transition: transform .2s; }
    .pf-project-card:hover .pf-project-link i { transform: translateX(3px); }

    .pf-project-ext-links { display: flex; gap: 8px; }
    .pf-project-ext-link {
        width: 30px; height: 30px;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: rgba(240,236,228,.45); font-size: 12px;
        background: rgba(255,255,255,.02);
        transition: border-color .2s, color .2s, background .2s;
    }
    .pf-project-ext-link:hover {
        border-color: rgba(200,169,110,.35);
        color: #c8a96e;
        background: rgba(200,169,110,.08);
    }
</style>