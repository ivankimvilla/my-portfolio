@extends('layouts.app')

@section('title', 'About Me - Ivan Kim Almadin')

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

    .ab-page {
        font-family: 'Outfit', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
    }
    /* Suppress global blue link color from layouts.app */
    .ab-page a { color: inherit; }
    .ab-page a:hover { color: var(--accent2); text-decoration: none; }

    /* ── SHARED ── */
    .ab-container {
        max-width: 1200px; margin: 0 auto;
        padding: 0 48px;
    }
    @media (max-width: 768px) { .ab-container { padding: 0 24px; } }

    .ab-eyebrow {
        display: inline-flex; align-items: center; gap: 10px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 20px;
    }
    .ab-eyebrow::before {
        content: ''; display: block;
        width: 28px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .ab-section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 300; line-height: 1.08;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px;
    }
    .ab-section-title em { font-style: italic; color: var(--accent); }

    .ab-divider {
        display: flex; align-items: center; gap: 14px;
        margin-bottom: 56px;
    }
    .ab-divider-line { flex: 1; height: 1px; background: var(--border); }
    .ab-divider-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: var(--accent); opacity: .4;
    }

    /* ══════════════════════════════
       HERO
    ══════════════════════════════ */
    .ab-hero {
        position: relative; overflow: hidden;
        padding: 80px 0 100px;
        border-bottom: 1px solid var(--border);
    }
    .ab-hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 55% 50% at 5% 30%, rgba(200,169,110,.08) 0%, transparent 60%),
            radial-gradient(ellipse 40% 55% at 90% 70%, rgba(200,169,110,.05) 0%, transparent 60%);
        pointer-events: none;
    }
    .ab-hero-rule {
        position: absolute; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .12;
    }
    .ab-hero-rule-top    { top: 0; }
    .ab-hero-rule-bottom { bottom: 0; }

    .ab-hero-inner {
        display: grid; grid-template-columns: 1fr 400px;
        gap: 72px; align-items: center;
        position: relative; z-index: 1;
    }

    .ab-hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
        border: 1px solid rgba(200,169,110,.25);
        background: rgba(200,169,110,.06);
        border-radius: 99px; padding: 6px 14px;
        margin-bottom: 28px;
    }

    .ab-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(48px, 5.5vw, 76px);
        font-weight: 300; line-height: 1.05;
        letter-spacing: -2px; color: var(--text);
        margin-bottom: 24px;
    }
    .ab-hero-title em { font-style: italic; color: var(--accent); }

    .ab-hero-desc {
        font-size: 15px; color: var(--muted);
        line-height: 1.85; margin-bottom: 16px;
        text-align: justify;
    }

    .ab-hero-actions { display: flex; gap: 16px; flex-wrap: wrap; margin-top: 36px; }

    .ab-btn-primary {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 14px 28px;
        background: transparent;
        border: 1px solid rgba(200,169,110,.5);
        border-radius: 10px; color: var(--accent2) !important;
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.8px;
        text-decoration: none; cursor: pointer;
        position: relative; overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .15s, color .25s;
    }
    .ab-btn-primary::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .ab-btn-primary:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.22);
        transform: translateY(-1px);
        color: #f5dfa0 !important;
    }
    .ab-btn-primary:hover::before { opacity: 1; }
    .ab-btn-primary span { position: relative; z-index: 1; color: inherit !important; }
    .ab-btn-primary i { color: inherit !important; }

    /* Photo card */
    .ab-photo {
        position: relative;
        animation: abFloat 6s ease-in-out infinite;
    }
    .ab-photo-glow {
        position: absolute; inset: -24px;
        background: radial-gradient(ellipse at center, rgba(200,169,110,.11), transparent 70%);
        pointer-events: none;
    }
    .ab-photo-frame {
        position: relative;
        border-radius: 20px; overflow: hidden;
        border: 1px solid rgba(200,169,110,.25);
        aspect-ratio: 4/5;
        background: var(--surface);
    }
    .ab-photo-frame img {
        width: 100%; height: 100%; object-fit: cover; display: block;
    }
    .ab-photo::before {
        content: '';
        position: absolute; top: -12px; right: -12px;
        width: 80px; height: 80px;
        border-top: 1px solid rgba(200,169,110,.3);
        border-right: 1px solid rgba(200,169,110,.3);
        border-radius: 0 12px 0 0;
        pointer-events: none; z-index: 2;
    }
    .ab-photo::after {
        content: '';
        position: absolute; bottom: -12px; left: -12px;
        width: 80px; height: 80px;
        border-bottom: 1px solid rgba(200,169,110,.3);
        border-left: 1px solid rgba(200,169,110,.3);
        border-radius: 0 0 0 12px;
        pointer-events: none; z-index: 2;
    }

    @keyframes abFloat {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-14px) rotate(0.3deg); }
    }

    /* ══════════════════════════════
       SKILLS
    ══════════════════════════════ */
    .ab-skills {
        padding: 100px 0;
        border-bottom: 1px solid var(--border);
        position: relative;
    }
    .ab-skills::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 50% 60% at 15% 50%, rgba(200,169,110,.04), transparent 60%);
        pointer-events: none;
    }

    .ab-skills-inner {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 72px; align-items: start;
    }

    /* Skill bars */
    .ab-skill-bars { display: flex; flex-direction: column; gap: 24px; }

    .ab-skill-bar-header {
        display: flex; justify-content: space-between;
        align-items: center; margin-bottom: 10px;
    }
    .ab-skill-bar-label {
        font-size: 13px; font-weight: 600;
        color: var(--text); letter-spacing: 0.3px;
    }
    .ab-skill-bar-pct {
        font-size: 11px; font-weight: 600;
        color: var(--accent); letter-spacing: 1px;
    }
    .ab-skill-bar-track {
        height: 3px; border-radius: 99px;
        background: rgba(255,255,255,.06);
        overflow: hidden;
    }
    .ab-skill-bar-fill {
        height: 100%; border-radius: 99px;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
        position: relative;
    }
    .ab-skill-bar-fill::after {
        content: '';
        position: absolute; right: 0; top: 50%;
        transform: translateY(-50%);
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--accent2);
        box-shadow: 0 0 8px rgba(232,201,138,.6);
    }

    /* Timeline */
    .ab-timeline { display: flex; flex-direction: column; gap: 28px; }

    .ab-timeline-item {
        display: flex; gap: 20px; align-items: flex-start;
        padding: 24px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        position: relative; overflow: hidden;
        transition: border-color .3s, transform .3s;
    }
    .ab-timeline-item::before {
        content: '';
        position: absolute; top: 0; left: 0; bottom: 0; width: 2px;
        background: linear-gradient(to bottom, var(--accent), transparent);
        opacity: 0; transition: opacity .3s;
    }
    .ab-timeline-item:hover {
        border-color: rgba(200,169,110,.2);
        transform: translateX(4px);
    }
    .ab-timeline-item:hover::before { opacity: 1; }

    .ab-timeline-icon {
        width: 44px; height: 44px; flex-shrink: 0;
        border-radius: 10px;
        border: 1px solid rgba(200,169,110,.25);
        background: rgba(200,169,110,.06);
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; color: var(--accent);
    }
    .ab-timeline-role {
        font-size: 15px; font-weight: 600;
        color: var(--text); margin-bottom: 4px;
    }
    .ab-timeline-company {
        font-size: 11px; font-weight: 600;
        color: var(--accent); letter-spacing: 1.5px;
        text-transform: uppercase; margin-bottom: 8px;
    }
    .ab-timeline-desc {
        font-size: 13px; color: var(--muted);
        line-height: 1.7;
    }

    /* ══════════════════════════════
       STATS / ACHIEVEMENTS
    ══════════════════════════════ */
    .ab-stats {
        padding: 100px 0;
        border-bottom: 1px solid var(--border);
        position: relative;
    }
    .ab-stats::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 60% 50% at 50% 50%, rgba(200,169,110,.05), transparent 60%);
        pointer-events: none;
    }

    .ab-stats-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .ab-stat-card {
        padding: 40px 32px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        text-align: center;
        position: relative; overflow: hidden;
        transition: border-color .3s, transform .3s, box-shadow .3s;
    }
    .ab-stat-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: 0; transition: opacity .3s;
    }
    .ab-stat-card:hover {
        border-color: rgba(200,169,110,.25);
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(0,0,0,.35), 0 0 0 1px rgba(200,169,110,.08);
    }
    .ab-stat-card:hover::before { opacity: .6; }

    .ab-stat-icon {
        width: 56px; height: 56px; margin: 0 auto 20px;
        border-radius: 14px;
        border: 1px solid rgba(200,169,110,.25);
        background: rgba(200,169,110,.06);
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; color: var(--accent);
    }
    .ab-stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 52px; font-weight: 300;
        line-height: 1; letter-spacing: -2px;
        color: var(--text); margin-bottom: 8px;
    }
    .ab-stat-number em { font-style: italic; color: var(--accent); }
    .ab-stat-label {
        font-size: 13px; font-weight: 600;
        color: var(--text); margin-bottom: 8px;
        text-transform: uppercase; letter-spacing: 1px;
    }
    .ab-stat-desc {
        font-size: 12px; color: var(--muted2);
        line-height: 1.6;
    }

    /* ══════════════════════════════
       CTA
    ══════════════════════════════ */
    .ab-cta {
        padding: 100px 0 120px;
        position: relative;
    }
    .ab-cta-inner {
        position: relative; overflow: hidden;
        border: 1px solid rgba(200,169,110,.18);
        border-radius: 24px; padding: 80px 64px;
        text-align: center;
        background: var(--surface);
    }
    .ab-cta-inner::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 70% 60% at 50% 0%, rgba(200,169,110,.1), transparent 60%),
            radial-gradient(ellipse 50% 40% at 50% 100%, rgba(200,169,110,.06), transparent 60%);
        pointer-events: none;
    }
    .ab-cta-inner::after {
        content: '';
        position: absolute; top: 0; left: 15%; right: 15%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18;
    }
    .ab-cta-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 300; line-height: 1.1;
        letter-spacing: -1.5px; color: var(--text);
        margin-bottom: 16px; position: relative; z-index: 1;
    }
    .ab-cta-title em { font-style: italic; color: var(--accent); }
    .ab-cta-desc {
        font-size: 15px; color: var(--muted);
        line-height: 1.8; max-width: 520px;
        margin: 0 auto 40px; position: relative; z-index: 1;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .ab-hero-inner  { grid-template-columns: 1fr; }
        .ab-photo       { display: none; }
        .ab-skills-inner { grid-template-columns: 1fr; gap: 48px; }
        .ab-stats-grid  { grid-template-columns: 1fr; }
        .ab-cta-inner   { padding: 56px 32px; }
    }
    @media (max-width: 640px) {
        .ab-stats-grid  { grid-template-columns: 1fr; }
    }

    /* ── ENTRANCE ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .ab-hero-left > * {
        animation: fadeUp .6s ease both;
    }
    .ab-hero-left > *:nth-child(1) { animation-delay: .08s; }
    .ab-hero-left > *:nth-child(2) { animation-delay: .16s; }
    .ab-hero-left > *:nth-child(3) { animation-delay: .24s; }
    .ab-hero-left > *:nth-child(4) { animation-delay: .32s; }
    .ab-hero-left > *:nth-child(5) { animation-delay: .40s; }
</style>

<div class="ab-page">
<div class="ab-container">

    {{-- ══ HERO ══ --}}
    <section class="ab-hero">
        <div class="ab-hero-rule ab-hero-rule-top"></div>
        <div class="ab-hero-rule ab-hero-rule-bottom"></div>

        <div class="ab-hero-inner">
            {{-- Left copy --}}
            <div class="ab-hero-left">
                <div class="ab-hero-tag">
                    <i class="fas fa-user" style="font-size:9px;"></i>
                    About Me
                </div>

                <h1 class="ab-hero-title">
                    I'm a<br>
                    <em>Full-Stack</em><br>
                    Developer.
                </h1>

                <p class="ab-hero-desc">
                    With over 5 years of experience in web development, I specialize in building scalable,
                    user-friendly applications that solve real business problems. My passion is turning
                    complex requirements into elegant, maintainable code.
                </p>
                <p class="ab-hero-desc">
                    I believe in clean architecture, continuous learning, and delivering products that exceed
                    expectations. I've worked with startups and established companies, always bringing a
                    solution-oriented mindset.
                </p>
                <p class="ab-hero-desc">
                    When I'm not coding, you'll find me contributing to open-source projects, writing
                    technical blogs, or exploring new technologies.
                </p>

                <div class="ab-hero-actions">
                    <a href="/portfolio" class="ab-btn-primary">
                        <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>View My Work</span>
                    </a>
                </div>
            </div>

            {{-- Right photo --}}
            <div class="ab-photo">
                <div class="ab-photo-glow"></div>
                <div class="ab-photo-frame">
                    <img src="{{ asset('home-hero.png') }}" alt="Ivan Kim Almadin">
                </div>
            </div>
        </div>
    </section>

    {{-- ══ SKILLS & EXPERIENCE ══ --}}
    <section class="ab-skills">
        <div class="ab-eyebrow">Expertise</div>
        <h2 class="ab-section-title">Technical <em>Skills.</em></h2>

        <div class="ab-divider">
            <div class="ab-divider-line"></div>
            <div class="ab-divider-dot"></div>
            <div class="ab-divider-line"></div>
        </div>

        <div class="ab-skills-inner">

                @php
                $defaultSkills = [
                    ['label' => 'Backend Development', 'pct' => '95%'],
                    ['label' => 'Frontend Development', 'pct' => '85%'],
                    ['label' => 'Database Design', 'pct' => '90%'],
                    ['label' => 'DevOps & Deployment', 'pct' => '80%'],
                ];
                $skills = $admin?->skills ?: $defaultSkills;
            @endphp

            <div>
                <div class="ab-eyebrow" style="margin-bottom:28px;">Professional Skills</div>
                <div class="ab-skill-bars">
                    @foreach ($skills as $skill)
                        @if (! empty($skill['label']))
                            @php
                                $pct = trim((string) ($skill['pct'] ?? ''));
                                $pctValue = rtrim($pct, '%');
                            @endphp
                            <div>
                                <div class="ab-skill-bar-header">
                                    <span class="ab-skill-bar-label">{{ $skill['label'] }}</span>
                                    <span class="ab-skill-bar-pct">{{ $pct ?: '0%' }}</span>
                                </div>
                                <div class="ab-skill-bar-track">
                                    <div class="ab-skill-bar-fill" style="width:{{ $pctValue ?: 0 }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Timeline --}}
            <div>
                <div class="ab-eyebrow" style="margin-bottom:28px;">Work Experience</div>
                <div class="ab-timeline">
                    <div class="ab-timeline-item">
                        <div class="ab-timeline-icon"><i class="fas fa-briefcase"></i></div>
                        <div>
                            <div class="ab-timeline-role">Senior Developer</div>
                            <div class="ab-timeline-company">Tech Startup Inc. &nbsp;·&nbsp; 2023 – Present</div>
                            <div class="ab-timeline-desc">Led development of microservices architecture serving 100k+ users.</div>
                        </div>
                    </div>
                    <div class="ab-timeline-item">
                        <div class="ab-timeline-icon"><i class="fas fa-code"></i></div>
                        <div>
                            <div class="ab-timeline-role">Full Stack Developer</div>
                            <div class="ab-timeline-company">Digital Agency Co. &nbsp;·&nbsp; 2021 – 2023</div>
                            <div class="ab-timeline-desc">Developed 15+ web applications for diverse clients across industries.</div>
                        </div>
                    </div>
                    <div class="ab-timeline-item">
                        <div class="ab-timeline-icon"><i class="fas fa-seedling"></i></div>
                        <div>
                            <div class="ab-timeline-role">Junior Developer</div>
                            <div class="ab-timeline-company">Web Solutions Ltd. &nbsp;·&nbsp; 2020 – 2021</div>
                            <div class="ab-timeline-desc">Started my journey building PHP and MySQL applications from the ground up.</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ══ STATS / ACHIEVEMENTS ══ --}}
    <section class="ab-stats">
        <div style="text-align:center;">
            <div class="ab-eyebrow" style="justify-content:center;">By the Numbers</div>
            <h2 class="ab-section-title" style="text-align:center;">Certifications &amp; <em>Achievements.</em></h2>
        </div>

        <div class="ab-divider" style="margin-top:16px;">
            <div class="ab-divider-line"></div>
            <div class="ab-divider-dot"></div>
            <div class="ab-divider-line"></div>
        </div>

        @php
            $defaultIcons = ['fas fa-trophy', 'fas fa-layer-group', 'fas fa-star'];
            $defaultStats = [
                ['number' => '5+', 'label' => 'Years Experience', 'desc' => 'Building professional web solutions across industries.'],
                ['number' => '50+', 'label' => 'Projects Delivered', 'desc' => 'Across startups, agencies, and enterprise clients.'],
                ['number' => '100%', 'label' => 'Client Satisfaction', 'desc' => 'Consistent positive reviews and long-term retention.'],
            ];
            $stats = $admin?->stats ?: $defaultStats;
        @endphp

        <div class="ab-stats-grid">
            @foreach ($stats as $index => $stat)
                @if (! empty($stat['number']) || ! empty($stat['label']))
                    @php
                        $number = trim((string) ($stat['number'] ?? ''));
                        $icon = $stat['icon'] ?? $defaultIcons[$index] ?? 'fas fa-award';
                    @endphp
                    <div class="ab-stat-card">
                        <div class="ab-stat-icon"><i class="{{ $icon }}"></i></div>
                        <div class="ab-stat-number">{{ $number }}</div>
                        <div class="ab-stat-label">{{ $stat['label'] ?? '' }}</div>
                        <div class="ab-stat-desc">{{ $stat['desc'] ?? '' }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="ab-cta">
        <div class="ab-cta-inner">
            <div class="ab-eyebrow" style="justify-content:center;">Let's Build Together</div>
            <h2 class="ab-cta-title">Ready to <em>collaborate?</em></h2>
            <p class="ab-cta-desc">
                Let's discuss how I can help bring your project to life and create something extraordinary together.
            </p>
            <a href="/contact" class="ab-btn-primary" style="display:inline-flex; position:relative; z-index:1;">
                <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>Get In Touch</span>
            </a>
        </div>
    </section>

</div>
</div>

@endsection