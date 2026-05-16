@extends('layouts.app')

@section('title', 'Portfolio - Ivan Kim Almadin')

@section('content')


<link rel="stylesheet" href="{{ asset('css/pages/portfolio.css') }}">

<div class="pf-port">
<div class="pf-container">

    {{-- ══ HERO HEADER ══ --}}
    <section class="port-hero">
        <div class="port-hero-rule port-hero-rule-top"></div>
        <div class="port-hero-rule port-hero-rule-bottom"></div>

        <div class="port-hero-inner">
            <div class="port-hero-tag">
                <i class="fas fa-layer-group" style="font-size:9px;"></i>
                Selected Work
            </div>

            <h1 class="port-hero-title">My <em>Projects.</em></h1>

            <p class="port-hero-desc">
                A curated collection of projects I've built — each one showcasing a different dimension
                of problem-solving, technical depth, and creative execution.
            </p>
        </div>
    </section>

    {{-- ══ FILTER BAR ══ --}}
    <div class="port-filters">
        <button class="port-filter-btn active" data-filter="all">
            <i class="fas fa-th" style="font-size:10px;"></i> All
        </button>
        <button class="port-filter-btn" data-filter="laravel">
            <i class="fab fa-laravel" style="font-size:10px;"></i> Laravel
        </button>
        <button class="port-filter-btn" data-filter="react">
            <i class="fab fa-react" style="font-size:10px;"></i> React
        </button>
        <button class="port-filter-btn" data-filter="php">
            <i class="fab fa-php" style="font-size:10px;"></i> PHP
        </button>
    </div>

    {{-- ══ PROJECTS GRID ══ --}}
    <section class="port-projects">

        <div class="pf-divider">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="port-projects-grid">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="port-empty">
                    <div class="port-empty-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <p>No projects yet. Check back soon!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="port-pagination">
            {{ $projects->links() }}
        </div>
    </section>

</div>
</div>

<script>
    // Filter button active state toggle
    document.querySelectorAll('.port-filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.port-filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
</script>

@endsection