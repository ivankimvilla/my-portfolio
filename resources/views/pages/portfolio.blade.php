@extends('layouts.app')

@section('title', 'Portfolio — Ivan Kim Almadin')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --bg:       #0b0c0e;
        --surface:  #111316;
        --surface2: #161820;
        --border:   rgba(255,255,255,.07);
        --accent:   #c8a96e;
        --accent2:  #e8c98a;
        --text:     #f0ece4;
        --muted:    rgba(240,236,228,.65);
        --muted2:   rgba(240,236,228,.22);
    }

    .pf-port {
        font-family: 'Outfit', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
    }

    /* ── CONTAINER ── */
    .pf-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 48px;
    }
    @media (max-width: 768px) { .pf-container { padding: 0 24px; } }

    /* ── SHARED ── */
    .pf-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 20px;
    }
    .pf-eyebrow::before {
        content: ''; display: block;
        width: 28px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .pf-section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 300; line-height: 1.08;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px;
    }
    .pf-section-title em { font-style: italic; color: var(--accent); }

    .pf-divider {
        display: flex; align-items: center; gap: 14px;
        margin-bottom: 48px;
    }
    .pf-divider-line { flex: 1; height: 1px; background: var(--border); }
    .pf-divider-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: var(--accent); opacity: .4;
    }

    /* ══════════════════════════════
       HERO HEADER
    ══════════════════════════════ */
    .port-hero {
        position: relative; overflow: hidden;
        padding: 80px 0 72px;
        border-bottom: 1px solid var(--border);
    }
    .port-hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 55% 60% at 10% 40%, rgba(200,169,110,.08) 0%, transparent 60%),
            radial-gradient(ellipse 40% 50% at 90% 60%, rgba(200,169,110,.05) 0%, transparent 60%);
        pointer-events: none;
    }
    .port-hero-rule {
        position: absolute; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .12;
    }
    .port-hero-rule-top    { top: 0; }
    .port-hero-rule-bottom { bottom: 0; }

    .port-hero-inner {
        position: relative; z-index: 1;
        display: flex; flex-direction: column;
        align-items: flex-start; gap: 0;
    }

    .port-hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
        border: 1px solid rgba(200,169,110,.25);
        background: rgba(200,169,110,.06);
        border-radius: 99px; padding: 6px 14px;
        margin-bottom: 28px;
    }

    .port-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(48px, 5.5vw, 76px);
        font-weight: 300; line-height: 1.05;
        letter-spacing: -2px; color: var(--text);
        margin-bottom: 20px;
    }
    .port-hero-title em { font-style: italic; color: var(--accent); }

    .port-hero-desc {
        font-size: 15px; color: var(--text);
        line-height: 1.85; max-width: 560px;
    }

    /* ══════════════════════════════
       FILTER BAR
    ══════════════════════════════ */
    .port-filters {
        padding: 40px 0 0;
        display: flex; gap: 10px; flex-wrap: wrap;
        margin-bottom: 48px;
    }

    .port-filter-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 20px;
        background: transparent;
        border: 1px solid var(--border);
        border-radius: 99px;
        color: var(--muted);
        font-family: 'Outfit', sans-serif;
        font-size: 12px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        cursor: pointer;
        transition: border-color .25s, color .25s, background .25s, box-shadow .25s;
    }
    .port-filter-btn:hover {
        border-color: rgba(200,169,110,.3);
        color: var(--accent);
    }
    .port-filter-btn.active {
        border-color: rgba(200,169,110,.5);
        background: rgba(200,169,110,.08);
        color: var(--accent2);
        box-shadow: 0 0 16px rgba(200,169,110,.1);
    }

    /* ══════════════════════════════
       PROJECTS SECTION
    ══════════════════════════════ */
    .port-projects {
        padding: 0 0 60px;
    }

    .port-projects-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 56px;
    }

    /* Empty state */
    .port-empty {
        grid-column: 1 / -1;
        padding: 80px 24px;
        display: flex; flex-direction: column;
        align-items: center; gap: 16px;
        border: 1px dashed rgba(200,169,110,.15);
        border-radius: 20px; text-align: center;
    }
    .port-empty-icon {
        width: 64px; height: 64px;
        border-radius: 16px;
        border: 1px solid rgba(200,169,110,.2);
        background: rgba(200,169,110,.05);
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; color: var(--accent); opacity: .5;
    }
    .port-empty p {
        font-size: 14px; color: var(--text);
    }

    /* ══════════════════════════════
       PAGINATION
    ══════════════════════════════ */
    .port-pagination {
        display: flex; justify-content: center;
        padding-bottom: 100px;
    }

    /* Override Laravel pagination to match theme */
    .port-pagination nav { display: flex; align-items: center; gap: 6px; }

    .port-pagination nav span,
    .port-pagination nav a {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 40px; height: 40px; padding: 0 14px;
        background: transparent;
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--muted);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 500;
        text-decoration: none;
        transition: border-color .25s, color .25s, background .25s;
    }
    .port-pagination nav a:hover {
        border-color: rgba(200,169,110,.3);
        color: var(--accent);
        background: rgba(200,169,110,.05);
    }
    .port-pagination nav span[aria-current="page"] {
        border-color: rgba(200,169,110,.5);
        background: rgba(200,169,110,.08);
        color: var(--accent2);
    }
    .port-pagination nav span.text-gray-700,
    .port-pagination nav span[aria-disabled="true"] {
        opacity: .3; cursor: not-allowed;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .port-projects-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .port-projects-grid { grid-template-columns: 1fr; }
        .port-hero { padding: 56px 0 48px; }
    }

    /* ── ENTRANCE ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .port-hero-inner > * {
        animation: fadeUp .6s ease both;
    }
    .port-hero-inner > *:nth-child(1) { animation-delay: .06s; }
    .port-hero-inner > *:nth-child(2) { animation-delay: .14s; }
    .port-hero-inner > *:nth-child(3) { animation-delay: .22s; }
</style>

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