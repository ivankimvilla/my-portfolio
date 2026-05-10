@extends('layouts.app')

@section('title', 'Ivan Kim Almadin - Full Stack Developer')

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
        --muted:    #f0ece4;
        --muted2:   rgba(240,236,228,.22);
    }

    .pf-home {
        font-family: 'Outfit', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
    }

    /* ── SHARED UTILITIES ── */
    .pf-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 20px;
    }
    .pf-eyebrow::before {
        content: ''; display: block;
        width: 28px; height: 1px; background: var(--accent); opacity: .7;
    }

    .pf-section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 300; line-height: 1.08;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px;
    }
    .pf-section-title em { font-style: italic; color: var(--accent); }

    .pf-section-desc {
        font-size: 15px; color: var(--muted);
        line-height: 1.8; max-width: 520px;
    }

    .pf-divider {
        display: flex; align-items: center; gap: 14px;
        margin-bottom: 56px;
    }
    .pf-divider-line { flex: 1; height: 1px; background: var(--border); }
    .pf-divider-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: var(--accent); opacity: .4;
    }

    /* ── CONTAINER ── */
    .pf-container {
        max-width: 1200px; margin: 0 auto;
        padding: 0 48px;
    }

    @media (max-width: 768px) {
        .pf-container { padding: 0 24px; }
    }

    /* ══════════════════════════════
       HERO
    ══════════════════════════════ */
    .pf-hero {
        position: relative; overflow: hidden;
        padding: 56px 0 100px;
    }

    .pf-hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 60% 50% at 10% 30%, rgba(200,169,110,.09) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 85% 70%, rgba(200,169,110,.06) 0%, transparent 60%);
        pointer-events: none;
        animation: heroBgDrift 10s ease-in-out infinite alternate;
    }

    /* Horizontal rule accents */
    .pf-hero-rule {
        position: absolute; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent 0%, var(--accent) 50%, transparent 100%);
        opacity: .12;
    }
    .pf-hero-rule-top    { top: 0; }
    .pf-hero-rule-bottom { bottom: 0; }

    .pf-hero-inner {
        display: grid; grid-template-columns: 1fr 420px;
        gap: 64px; align-items: center;
        position: relative; z-index: 1;
    }

    .pf-hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
        border: 1px solid rgba(200,169,110,.25);
        background: rgba(200,169,110,.06);
        border-radius: 99px; padding: 6px 14px;
        margin-bottom: 28px;
    }

    .pf-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(52px, 6vw, 80px);
        font-weight: 300; line-height: 1.05;
        letter-spacing: -2px; color: var(--text);
        margin-bottom: 20px;
    }
    .pf-hero-title em { font-style: italic; color: var(--accent); }

    .pf-hero-role {
        font-size: 16px; font-weight: 500;
        color: var(--muted); letter-spacing: 0.3px;
        margin-bottom: 20px;
    }

    .pf-hero-desc {
        font-size: 15px; color: var(--muted);
        line-height: 1.8; max-width: 460px; margin-bottom: 44px;
        text-align: justify;
    }

    .pf-hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }

    .pf-btn-primary {
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
    .pf-btn-primary::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .pf-btn-primary:hover {
        border-color: var(--accent2);
        color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.18);
        transform: translateY(-1px);
    }
    .pf-btn-primary:hover::before { opacity: 1; }
    .pf-btn-primary span { position: relative; z-index: 1; }

    .pf-btn-ghost {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 14px 28px;
        border: 1px solid var(--border);
        border-radius: 10px; color: var(--muted);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        text-decoration: none;
        transition: border-color .25s, color .25s, transform .15s;
    }
    .pf-btn-ghost:hover {
        border-color: rgba(200,169,110,.3);
        color: var(--accent);
        transform: translateY(-1px);
    }

    /* Hero photo card */
    .pf-hero-photo {
        position: relative;
    }

    .pf-hero-photo-glow {
        position: absolute; inset: -24px;
        background: radial-gradient(ellipse at center, rgba(200,169,110,.12), transparent 70%);
        pointer-events: none;
        animation: glowPulse 6s ease-in-out infinite alternate;
    }

    .pf-hero-photo-frame {
        position: relative;
        border-radius: 20px; overflow: hidden;
        border: 1px solid rgba(200,169,110,.25);
        aspect-ratio: 4/5;
        background: var(--surface);
    }

    .pf-hero-photo-frame img {
        width: 100%; height: 100%; object-fit: cover;
        display: block;
    }

    /* Hover reveal overlay */
    .pf-hero-photo-overlay {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: linear-gradient(to top, rgba(0,0,0,.85) 0%, transparent 100%);
        padding: 28px 24px 24px;
        transform: translateY(100%);
        transition: transform .35s ease;
    }
    .pf-hero-photo-frame:hover .pf-hero-photo-overlay { transform: translateY(0); }

    .pf-hero-photo-overlay-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 400;
        color: var(--text); margin-bottom: 4px;
    }
    .pf-hero-photo-overlay-role {
        font-size: 12px; color: var(--accent);
        text-transform: uppercase; letter-spacing: 1.5px;
    }

    /* Corner deco */
    .pf-hero-photo::before {
        content: '';
        position: absolute; top: -12px; right: -12px;
        width: 80px; height: 80px;
        border-top: 1px solid rgba(200,169,110,.3);
        border-right: 1px solid rgba(200,169,110,.3);
        border-radius: 0 12px 0 0;
        pointer-events: none; z-index: 2;
    }
    .pf-hero-photo::after {
        content: '';
        position: absolute; bottom: -12px; left: -12px;
        width: 80px; height: 80px;
        border-bottom: 1px solid rgba(200,169,110,.3);
        border-left: 1px solid rgba(200,169,110,.3);
        border-radius: 0 0 0 12px;
        pointer-events: none; z-index: 2;
    }

    /* ══════════════════════════════
       FEATURED PROJECTS
    ══════════════════════════════ */
    .pf-projects {
        padding: 100px 0;
        border-top: 1px solid var(--border);
        position: relative;
    }

    .pf-projects::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 50% 60% at 80% 50%, rgba(200,169,110,.04), transparent 60%);
        pointer-events: none;
    }

    .pf-projects-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 16px; gap: 24px; flex-wrap: wrap;
    }

    .pf-projects-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    /* Empty state */
    .pf-projects-empty {
        grid-column: 1/-1;
        padding: 80px 24px;
        display: flex; flex-direction: column;
        align-items: center; gap: 16px;
        border: 1px dashed rgba(200,169,110,.15);
        border-radius: 16px; text-align: center;
    }
    .pf-projects-empty i { font-size: 40px; color: var(--accent); opacity: .4; }
    .pf-projects-empty p { font-size: 14px; color: #ffffff; }

    /* ══════════════════════════════
       TECHNICAL SKILLS
    ══════════════════════════════ */
    .pf-skills {
        padding: 100px 0;
        border-top: 1px solid var(--border);
        position: relative;
    }

    .pf-skills::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 50% 60% at 15% 50%, rgba(200,169,110,.04), transparent 60%);
        pointer-events: none;
    }

    .pf-skills-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
    }

    .pf-skill-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px; padding: 32px 28px;
        position: relative; overflow: hidden;
        transition: border-color .3s, transform .3s, box-shadow .3s;
    }

    .pf-skill-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: 0; transition: opacity .3s;
    }

    .pf-skill-card:hover {
        border-color: rgba(200,169,110,.25);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0,0,0,.3), 0 0 0 1px rgba(200,169,110,.08);
    }
    .pf-skill-card:hover::before { opacity: .6; }

    .pf-skill-icon {
        width: 52px; height: 52px;
        border: 1px solid rgba(200,169,110,.25);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: var(--accent);
        background: rgba(200,169,110,.06);
        margin-bottom: 20px;
        transition: transform .3s;
    }
    .pf-skill-card:hover .pf-skill-icon { transform: scale(1.1); }

    .pf-skill-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px; font-weight: 600;
        color: var(--text); margin-bottom: 16px;
        letter-spacing: -0.3px;
    }

    .pf-skill-list {
        list-style: none; padding: 0; margin: 0;
        display: flex; flex-direction: column; gap: 9px;
    }

    .pf-skill-list li {
        display: flex; align-items: center; gap: 10px;
        font-size: 13px; color: var(--muted);
    }

    .pf-skill-list li::before {
        content: ''; display: block;
        width: 5px; height: 1px;
        background: var(--accent); opacity: .6; flex-shrink: 0;
    }

    /* ══════════════════════════════
       CTA BANNER
    ══════════════════════════════ */
    .pf-cta {
        padding: 100px 0;
        border-top: 1px solid var(--border);
    }

    .pf-cta-inner {
        position: relative; overflow: hidden;
        border: 1px solid rgba(200,169,110,.18);
        border-radius: 24px;
        padding: 80px 64px;
        text-align: center;
        background: var(--surface);
    }

    .pf-cta-inner::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 70% 60% at 50% 0%, rgba(200,169,110,.1), transparent 60%),
            radial-gradient(ellipse 50% 40% at 50% 100%, rgba(200,169,110,.06), transparent 60%);
        pointer-events: none;
    }

    /* Top & bottom rules */
    .pf-cta-inner::after {
        content: '';
        position: absolute; top: 0; left: 15%; right: 15%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18;
    }

    .pf-cta-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 300; line-height: 1.1;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px; position: relative; z-index: 1;
    }
    .pf-cta-title em { font-style: italic; color: var(--accent); }

    .pf-cta-desc {
        font-size: 15px; color: var(--muted);
        line-height: 1.8; max-width: 520px;
        margin: 0 auto 40px; position: relative; z-index: 1;
    }

    /* ══════════════════════════════
       CONTACT
    ══════════════════════════════ */
    .pf-contact {
        padding: 100px 0 120px;
        border-top: 1px solid var(--border);
        position: relative;
    }

    .pf-contact::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 60% 50% at 50% 100%, rgba(200,169,110,.05), transparent 60%);
        pointer-events: none;
    }

    .pf-contact-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 80px; align-items: start;
    }

    .pf-contact-cards { display: flex; flex-direction: column; gap: 16px; }

    .pf-contact-card {
        display: flex; gap: 16px; align-items: flex-start;
        padding: 20px 22px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        transition: border-color .25s, transform .25s;
    }
    .pf-contact-card:hover {
        border-color: rgba(200,169,110,.25);
        transform: translateX(4px);
        box-shadow: 0 0 0 1px rgba(200,169,110,.06);
    }

    .pf-contact-icon {
        width: 46px; height: 46px; flex-shrink: 0;
        border: 1px solid rgba(200,169,110,.25);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; color: var(--accent);
        background: rgba(200,169,110,.06);
    }

    .pf-contact-card-title {
        font-size: 13px; font-weight: 600;
        color: var(--text); margin-bottom: 4px;
        text-transform: uppercase; letter-spacing: 0.8px;
    }
    .pf-contact-card-value {
        font-size: 14px; color: var(--muted); margin-bottom: 3px;
    }
    .pf-contact-card-note {
        font-size: 11px; color: var(--muted2);
    }

    .pf-social-links { display: flex; gap: 14px; margin-top: 4px; }
    .pf-social-link {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 500;
        color: var(--accent); text-decoration: none;
        letter-spacing: 0.3px;
        transition: opacity .2s;
    }
    .pf-social-link:hover { opacity: .7; }

    /* ── HERO MOTION ANIMATIONS ── */
    @keyframes heroFloat {
        0%   { transform: translateY(0px) rotate(0deg); }
        50%  { transform: translateY(-18px) rotate(0.4deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }

    @keyframes heroBgDrift {
        0%   { opacity: 1;   transform: scale(1)    translateX(0px)   translateY(0px); }
        33%  { opacity: .85; transform: scale(1.08) translateX(22px)  translateY(-14px); }
        66%  { opacity: .9;  transform: scale(1.05) translateX(-14px) translateY(11px); }
        100% { opacity: 1;   transform: scale(1.09) translateX(18px)  translateY(-8px); }
    }

    @keyframes glowPulse {
        0%   { opacity: .6;  transform: scale(1); }
        50%  { opacity: 1;   transform: scale(1.22); }
        100% { opacity: .75; transform: scale(1.1); }
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .pf-hero-left > * {
        animation: fadeUp .6s ease both;
    }
    .pf-hero-left > *:nth-child(1) { animation-delay: .08s; }
    .pf-hero-left > *:nth-child(2) { animation-delay: .16s; }
    .pf-hero-left > *:nth-child(3) { animation-delay: .24s; }
    .pf-hero-left > *:nth-child(4) { animation-delay: .32s; }
    .pf-hero-left > *:nth-child(5) { animation-delay: .40s; }

    .pf-hero-photo { animation: fadeIn .8s ease both .25s, heroFloat 5s ease-in-out infinite; }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .pf-skills-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 900px) {
        .pf-hero-inner { grid-template-columns: 1fr; }
        .pf-hero-photo { display: block; margin-top: 40px; }
        .pf-hero-photo-frame { max-width: 280px; margin: 0 auto; }
        .pf-hero-photo-overlay { transform: translateY(0) !important; }
        .pf-projects-grid { grid-template-columns: 1fr 1fr; }
        .pf-contact-grid { grid-template-columns: 1fr; gap: 48px; }
        .pf-cta-inner { padding: 56px 32px; }
    }

    @media (max-width: 640px) {
        .pf-projects-grid { grid-template-columns: 1fr; }
        .pf-skills-grid { grid-template-columns: 1fr; }
        .pf-hero { padding: 40px 0 64px; }
    }

    /* ── CERTIFICATES ── */
    .pf-certificates {
        padding: 120px 0;
        background: #0b0c0e;
        color: #f0ece4;
    }

    .pf-certificates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .pf-certificate-card {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .pf-certificate-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .pf-certificate-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .pf-certificate-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s ease;
    }

    .pf-certificate-card:hover .pf-certificate-image img {
        transform: scale(1.05);
    }

    .pf-certificate-content {
        padding: 1.5rem;
    }

    .pf-certificate-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #f0ece4;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .pf-certificate-issuer {
        font-size: 0.9rem;
        color: #c8a96e;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .pf-certificate-date {
        font-size: 0.85rem;
        color: rgba(240, 236, 228, 0.7);
        margin-bottom: 0.75rem;
    }

    .pf-certificate-desc {
        font-size: 0.9rem;
        color: rgba(240, 236, 228, 0.8);
        line-height: 1.5;
        margin: 0;
    }

    .pf-certificates-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        color: rgba(240, 236, 228, 0.6);
    }

    .pf-certificates-empty i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .pf-certificates-empty p {
        font-size: 1.1rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .pf-certificates {
            padding: 80px 0;
        }

        .pf-certificates-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>

<div class="pf-home">
<div class="pf-container">

    {{-- ══ HERO ══ --}}
    <section class="pf-hero">
        <div class="pf-hero-rule pf-hero-rule-top"></div>
        <div class="pf-hero-rule pf-hero-rule-bottom"></div>

        <div class="pf-hero-inner">
            {{-- Left copy --}}
            <div class="pf-hero-left">
                <div class="pf-hero-tag">
                    <i class="fas fa-circle" style="font-size:6px; color:#4ade80;"></i>
                    Available for Projects
                </div>

                <h1 class="pf-hero-title">
                    Hi, I'm<br>
                    <em>Ivan Kim</em><br>
                    Almadin.
                </h1>

                <p class="pf-hero-role">Laravel Full-Stack Developer</p>

                <p class="pf-hero-desc">
                    A Full-Stack Web Developer focused on building elegant and scalable solutions for complex problems, specializing in modern Laravel-based web applications and impactful digital experiences.
                </p>

                <div class="pf-hero-actions">
                    <a href="#contact" class="pf-btn-primary">
                        <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>Start a Project</span>
                    </a>
                    <a href="/portfolio" class="pf-btn-primary">
                        View My Work
                    </a>
                </div>
            </div>

            {{-- Right photo --}}
            <div class="pf-hero-photo">
                <div class="pf-hero-photo-glow"></div>
                <div class="pf-hero-photo-frame">
                    <img src="{{ asset('home-hero.png') }}" alt="Ivan Kim Almadin">
                    <div class="pf-hero-photo-overlay">
                        <div class="pf-hero-photo-overlay-name">Ivan Kim Almadin</div>
                        <div class="pf-hero-photo-overlay-role">Laravel Full-Stack Developer</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══ FEATURED PROJECTS ══ --}}
    <section class="pf-projects">
        <div class="pf-projects-header">
            <div>
                <div class="pf-eyebrow">Selected Work</div>
                <h2 class="pf-section-title">Featured <em>Projects.</em></h2>
            </div>
            <p class="pf-section-desc">
                A selection of recent work showcasing modern web development practices and creative problem-solving.
            </p>
        </div>

        <div class="pf-divider">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="pf-projects-grid">
            @forelse($featuredProjects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="pf-projects-empty">
                    <i class="fas fa-rocket"></i>
                    <p>Featured projects coming soon.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ══ TECHNICAL SKILLS ══ --}}
    <section class="pf-skills">
        <div class="pf-eyebrow">Capabilities</div>
        <h2 class="pf-section-title">Technical <em>Expertise.</em></h2>
        <p class="pf-section-desc" style="margin-bottom: 0;">
            A comprehensive toolkit of technologies and skills built through years of hands-on work.
        </p>

        <div class="pf-divider" style="margin-top: 32px;">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="pf-skills-grid">
            <div class="pf-skill-card">
                <div class="pf-skill-icon"><i class="fas fa-cogs"></i></div>
                <div class="pf-skill-name">Backend</div>
                <ul class="pf-skill-list">
                    <li>PHP / Laravel</li>
                    <li>Node.js</li>
                    <li>REST APIs</li>
                    <li>Database Design</li>
                </ul>
            </div>

            <div class="pf-skill-card">
                <div class="pf-skill-icon"><i class="fas fa-palette"></i></div>
                <div class="pf-skill-name">Frontend</div>
                <ul class="pf-skill-list">
                    <li>React / Vue</li>
                    <li>Tailwind CSS</li>
                    <li>JavaScript / TypeScript</li>
                    <li>Responsive Design</li>
                </ul>
            </div>

            <div class="pf-skill-card">
                <div class="pf-skill-icon"><i class="fas fa-database"></i></div>
                <div class="pf-skill-name">Database</div>
                <ul class="pf-skill-list">
                    <li>MySQL</li>
                    <li>PostgreSQL</li>
                    <li>MongoDB</li>
                    <li>Query Optimisation</li>
                </ul>
            </div>

            <div class="pf-skill-card">
                <div class="pf-skill-icon"><i class="fas fa-tools"></i></div>
                <div class="pf-skill-name">DevOps</div>
                <ul class="pf-skill-list">
                    <li>Git / GitHub</li>
                    <li>Docker</li>
                    <li>AWS / Azure</li>
                    <li>CI/CD Pipelines</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- ══ CERTIFICATES ══ --}}
    <section class="pf-certificates">
        <div class="pf-eyebrow">Certifications</div>
        <h2 class="pf-section-title">Professional <em>Credentials</em></h2>
        <p class="pf-section-desc">
            Validated expertise and continuous learning through recognized certifications.
        </p>

        <div class="pf-divider">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="pf-certificates-grid">
            @forelse(\App\Models\Certificate::where('is_active', true)->latest()->get() as $certificate)
            <div class="pf-certificate-card">
                @if($certificate->certificate_path)
                <div class="pf-certificate-image">
                    <img src="{{ asset($certificate->certificate_path) }}" alt="{{ $certificate->title }}" loading="lazy">
                </div>
                @endif
                <div class="pf-certificate-content">
                    <h3 class="pf-certificate-title">{{ $certificate->title }}</h3>
                    <div class="pf-certificate-issuer">{{ $certificate->issuer }}</div>
                    <div class="pf-certificate-date">{{ $certificate->issue_date->format('M Y') }}</div>
                    @if($certificate->description)
                    <p class="pf-certificate-desc">{{ $certificate->description }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="pf-certificates-empty">
                <i class="fas fa-certificate"></i>
                <p>Certificates coming soon...</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="pf-cta">
        <div class="pf-cta-inner">
            <div class="pf-eyebrow" style="justify-content:center;">Let's Build Together</div>
            <h2 class="pf-cta-title">Ready to <em>collaborate?</em></h2>
            <p class="pf-cta-desc">
                Let's discuss your project and create something extraordinary together. I'm always open to new ideas and challenges.
            </p>
            <a href="#contact" class="pf-btn-primary" style="display:inline-flex; position:relative; z-index:1;">
                <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>Start a Conversation</span>
            </a>
        </div>
    </section>

    {{-- ══ CONTACT ══ --}}
    <section class="pf-contact" id="contact">
        <div class="pf-eyebrow">Contact</div>
        <h2 class="pf-section-title">Let's <em>Connect.</em></h2>
        <p class="pf-section-desc" style="margin-bottom:0;">
            Reach out to discuss your project or explore collaborations.
        </p>

        <div class="pf-divider" style="margin-top: 32px;">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="pf-contact-grid">
            {{-- Contact Form --}}
            <div>
                <x-contact-form :showHeading="false" />
            </div>

            {{-- Contact Info --}}
            <div class="pf-contact-cards">
                <div class="pf-contact-card">
                    <div class="pf-contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="pf-contact-card-title">Email</div>
                        <div class="pf-contact-card-value">ivanalmadin0@gmail.com</div>
                        <div class="pf-contact-card-note">I'll respond within 24 hours</div>
                    </div>
                </div>

                <div class="pf-contact-card">
                    <div class="pf-contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="pf-contact-card-title">Phone</div>
                        <div class="pf-contact-card-value">+63 (953) 578-6765</div>
                        <div class="pf-contact-card-note">Available Monday–Friday, 8:00 AM–6:00 PM PHT</div>
                    </div>
                </div>

                <div class="pf-contact-card">
                    <div class="pf-contact-icon"><i class="fas fa-link"></i></div>
                    <div>
                        <div class="pf-contact-card-title">Social</div>
                        <div class="pf-social-links">
                            <a href="https://github.com/ivankimvilla" target="_blank" rel="noopener" class="pf-social-link"><i class="fab fa-github"></i>GitHub</a>
                            <a href="https://www.linkedin.com/in/ivan-kim-almadin-483b16408/" target="_blank" rel="noopener" class="pf-social-link"><i class="fab fa-linkedin"></i>LinkedIn</a>
                            <a href="https://x.com/AlmadinIvan" target="_blank" rel="noopener" class="pf-social-link"><i class="fab fa-twitter"></i>Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</div>

@endsection