@extends('layouts.app')

@section('title', 'Services - Ivan Kim Almadin')

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

    .sv-page {
        font-family: 'Outfit', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
    }

    /* ── CONTAINER ── */
    .sv-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 48px;
    }
    @media (max-width: 768px) { .sv-container { padding: 0 24px; } }

    /* ── SHARED ── */
    .sv-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 20px;
    }
    .sv-eyebrow::before {
        content: ''; display: block;
        width: 28px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .sv-section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 300; line-height: 1.08;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px;
    }
    .sv-section-title em { font-style: italic; color: var(--accent); }

    .sv-divider {
        display: flex; align-items: center; gap: 14px;
        margin-bottom: 56px;
    }
    .sv-divider-line { flex: 1; height: 1px; background: var(--border); }
    .sv-divider-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: var(--accent); opacity: .4;
    }

    .sv-btn-primary {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 14px 28px;
        background: transparent;
        border: 1px solid rgba(200,169,110,.5);
        border-radius: 10px; color: var(--accent2);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        text-decoration: none; cursor: pointer;
        position: relative; overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .15s;
    }
    .sv-btn-primary::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .sv-btn-primary:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.18);
        transform: translateY(-1px);
    }
    .sv-btn-primary:hover::before { opacity: 1; }
    .sv-btn-primary span { position: relative; z-index: 1; }

    /* ══════════════════════════════
       HERO HEADER
    ══════════════════════════════ */
    .sv-hero {
        position: relative; overflow: hidden;
        padding: 80px 0 72px;
        border-bottom: 1px solid var(--border);
    }
    .sv-hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 55% 60% at 8% 40%, rgba(200,169,110,.08) 0%, transparent 60%),
            radial-gradient(ellipse 40% 50% at 92% 60%, rgba(200,169,110,.05) 0%, transparent 60%);
        pointer-events: none;
    }
    .sv-hero-rule {
        position: absolute; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .12;
    }
    .sv-hero-rule-top    { top: 0; }
    .sv-hero-rule-bottom { bottom: 0; }

    .sv-hero-inner {
        position: relative; z-index: 1;
        text-align: center;
        display: flex; flex-direction: column;
        align-items: center;
    }

    .sv-hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
        border: 1px solid rgba(200,169,110,.25);
        background: rgba(200,169,110,.06);
        border-radius: 99px; padding: 6px 14px;
        margin-bottom: 28px;
    }

    .sv-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(48px, 5.5vw, 80px);
        font-weight: 300; line-height: 1.05;
        letter-spacing: -2px; color: var(--text);
        margin-bottom: 20px;
    }
    .sv-hero-title em { font-style: italic; color: var(--accent); }

    .sv-hero-desc {
        font-size: 15px; color: var(--text);
        line-height: 1.85; max-width: 580px;
        text-align: center;
    }

    /* ══════════════════════════════
       SERVICES GRID
    ══════════════════════════════ */
    .sv-section {
        padding: 100px 0;
        border-bottom: 1px solid var(--border);
        position: relative;
    }
    .sv-section::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 60% 50% at 80% 50%, rgba(200,169,110,.04), transparent 60%);
        pointer-events: none;
    }

    .sv-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    /* Empty state */
    .sv-empty {
        grid-column: 1 / -1;
        padding: 80px 24px;
        display: flex; flex-direction: column;
        align-items: center; gap: 16px;
        border: 1px dashed rgba(200,169,110,.15);
        border-radius: 20px; text-align: center;
    }
    .sv-empty-icon {
        width: 64px; height: 64px;
        border-radius: 16px;
        border: 1px solid rgba(200,169,110,.2);
        background: rgba(200,169,110,.05);
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; color: var(--accent); opacity: .5;
    }
    .sv-empty p { font-size: 14px; color: var(--text); }

    /* ══════════════════════════════
       CTA BANNER
    ══════════════════════════════ */
    .sv-cta {
        padding: 100px 0 120px;
        position: relative;
    }
    .sv-cta-inner {
        position: relative; overflow: hidden;
        border: 1px solid rgba(200,169,110,.18);
        border-radius: 24px;
        padding: 80px 64px;
        text-align: center;
        background: var(--surface);
    }
    .sv-cta-inner::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 70% 60% at 50% 0%, rgba(200,169,110,.10), transparent 60%),
            radial-gradient(ellipse 50% 40% at 50% 100%, rgba(200,169,110,.06), transparent 60%);
        pointer-events: none;
    }
    .sv-cta-inner::after {
        content: '';
        position: absolute; top: 0; left: 15%; right: 15%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18;
    }

    .sv-cta-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(36px, 4.5vw, 58px);
        font-weight: 300; line-height: 1.1;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px; position: relative; z-index: 1;
    }
    .sv-cta-title em { font-style: italic; color: var(--accent); }

    .sv-cta-desc {
        font-size: 15px; color: var(--text);
        line-height: 1.8; max-width: 500px;
        margin: 0 auto 40px; position: relative; z-index: 1;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .sv-grid { grid-template-columns: 1fr; }
        .sv-cta-inner { padding: 56px 32px; }
    }

    /* ── ENTRANCE ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .sv-hero-inner > * {
        animation: fadeUp .6s ease both;
    }
    .sv-hero-inner > *:nth-child(1) { animation-delay: .06s; }
    .sv-hero-inner > *:nth-child(2) { animation-delay: .14s; }
    .sv-hero-inner > *:nth-child(3) { animation-delay: .22s; }
</style>

<div class="sv-page">
<div class="sv-container">

    {{-- ══ HERO HEADER ══ --}}
    <section class="sv-hero">
        <div class="sv-hero-rule sv-hero-rule-top"></div>
        <div class="sv-hero-rule sv-hero-rule-bottom"></div>

        <div class="sv-hero-inner">
            <div class="sv-hero-tag">
                <i class="fas fa-concierge-bell" style="font-size:9px;"></i>
                What I Offer
            </div>

            <h1 class="sv-hero-title">My <em>Services.</em></h1>

            <p class="sv-hero-desc">
                Comprehensive web development and consulting services tailored to help your
                business grow and succeed in the digital landscape.
            </p>
        </div>
    </section>

    {{-- ══ SERVICES GRID ══ --}}
    <section class="sv-section">
        <div class="sv-eyebrow">Capabilities</div>
        <h2 class="sv-section-title">What I <em>Do.</em></h2>

        <div class="sv-divider">
            <div class="sv-divider-line"></div>
            <div class="sv-divider-dot"></div>
            <div class="sv-divider-line"></div>
        </div>

        <div class="sv-grid">
            @forelse($services as $service)
                <x-service-card :service="$service" />
            @empty
                <div class="sv-empty">
                    <div class="sv-empty-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <p>No services configured yet.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="sv-cta">
        <div class="sv-cta-inner">
            <div class="sv-eyebrow" style="justify-content:center;">Custom Solutions</div>
            <h2 class="sv-cta-title">Can't find what you're <em>looking for?</em></h2>
            <p class="sv-cta-desc">
                I also offer custom solutions tailored to your specific needs. Let's talk and figure out exactly what works for you.
            </p>
            <a href="/contact" class="sv-btn-primary" style="display:inline-flex; position:relative; z-index:1;">
                <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>Let's Discuss</span>
            </a>
        </div>
    </section>

</div>
</div>

@endsection