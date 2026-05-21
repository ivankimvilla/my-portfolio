@extends('layouts.app')

@section('title', $project->title)

@section('content')

<link rel="stylesheet" href="{{ asset('css/pages/portfolio-detail.css') }}">

<div class="pd-page">
<div class="pd-container">

    {{-- ══ HERO HEADER ══ --}}
    <section class="pd-hero">
        <div class="pd-hero-rule pd-hero-rule-top"></div>
        <div class="pd-hero-rule pd-hero-rule-bottom"></div>

        <div class="pd-hero-inner">
            <a href="/portfolio" class="pd-back-link">
                <i class="fas fa-arrow-left"></i> Back to Portfolio
            </a>

            <div class="pd-eyebrow">Work Detail</div>

            <h1 class="pd-hero-title">{{ $project->title }}</h1>
            <p class="pd-hero-desc">{{ $project->description }}</p>

            <div class="pd-hero-meta">
                @if($project->live_url)
                <span class="pd-meta-tag"><i class="fas fa-globe"></i> Live Work</span>
                @endif
                @if($project->github_url)
                <span class="pd-meta-tag"><i class="fab fa-github"></i> Open Source</span>
                @endif
                @if($project->technologies && count($project->technologies))
                <span class="pd-meta-tag"><i class="fas fa-layer-group"></i> {{ count($project->technologies) }} Technologies</span>
                @endif
            </div>
        </div>
    </section>

    {{-- ══ FEATURED IMAGE ══ --}}
    <div class="pd-image-section">
        <div class="pd-image-frame">
            @if($project->image_url)
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}">
            @else
                <div class="pd-image-placeholder">
                    <i class="fas fa-image"></i>
                    <span>Work Preview</span>
                </div>
            @endif
        </div>
    </div>

    {{-- ══ MAIN CONTENT ══ --}}
    <section class="pd-content-section">
        <div class="pd-content-grid">

            {{-- Left: Overview + Role --}}
            <div>
                <div class="pd-eyebrow">Overview</div>
                <h2 class="pd-section-heading">Work <em>Breakdown.</em></h2>

                @if($project->problem_solution)
                <div class="pd-body-text">
                    {!! nl2br(e($project->problem_solution)) !!}
                </div>
                @else
                <p class="pd-body-text">{{ $project->description }}</p>
                @endif

                @if($project->role)
                <div class="pd-role-block">
                    <h3>My Role</h3>
                    <p>{!! nl2br(e($project->role)) !!}</p>
                </div>
                @endif

                <div class="pd-divider">
                    <div class="pd-divider-line"></div>
                    <div class="pd-divider-dot"></div>
                    <div class="pd-divider-line"></div>
                </div>
            </div>

            {{-- Right: Sidebar --}}
            <div>
                <div class="pd-sidebar-card">

                    @if($project->technologies && count($project->technologies))
                    <div class="pd-sidebar-section-title">Technologies</div>
                    <div class="pd-tech-tags">
                        @foreach($project->technologies as $tech)
                        <span class="pd-tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <div class="pd-sidebar-divider"></div>
                    @endif

                    <div class="pd-sidebar-section-title">Links</div>

                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="pd-btn-primary">
                        <span><i class="fas fa-external-link-alt"></i> View Live Demo</span>
                    </a>
                    @endif

                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="pd-btn-ghost">
                        <i class="fab fa-github"></i> View Code on GitHub
                    </a>
                    @endif

                    @if(!$project->live_url && !$project->github_url)
                    <p style="font-size:13px; color:var(--muted); text-align:center; padding: 12px 0;">No links available yet.</p>
                    @endif

                </div>
            </div>

        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="pd-cta">
        <div class="pd-cta-inner">
            <div class="pd-eyebrow" style="justify-content:center;">Let's Build Together</div>
            <h2 class="pd-cta-title">Like what you <em>see?</em></h2>
            <p class="pd-cta-desc">
                Let's discuss how I can help bring your next project to life with elegant, scalable solutions.
            </p>
            <a href="/#contact" class="pd-cta-btn">
                <span><i class="fas fa-arrow-right" style="margin-right:6px;"></i>Start a Conversation</span>
            </a>
        </div>
    </section>

</div>
</div>
@endsection