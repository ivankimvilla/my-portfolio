@extends('layouts.app')

@section('title', 'About Me - Ivan Kim Almadin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">

<div class="ab-page">

    {{-- ══ HERO ══ --}}
    <section class="ab-hero">
        <canvas id="ab-neural-canvas"></canvas>
        <div class="ab-hero-rule ab-hero-rule-top"></div>
        <div class="ab-hero-rule ab-hero-rule-bottom"></div>

        <div class="ab-container">
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
                    <a href="{{ route('resume.download') }}" class="ab-btn-primary" title="Download Resume">
                        <span><i class="fas fa-download" style="margin-right:7px;"></i>Download Resume</span>
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
        </div>{{-- /.ab-container --}}
    </section>

<div class="ab-container">
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
                <div class="ab-eyebrow" style="margin-bottom:12px;">Proficiency</div>
                <h3 style="font-family:'Cormorant Garamond',serif;font-size:clamp(26px,3vw,38px);font-weight:300;letter-spacing:-0.8px;color:var(--text);line-height:1.1;margin:0 0 36px;">Professional <em style="font-style:italic;color:var(--accent);">Skills</em></h3>
                <div class="ab-skill-bars-wrap">
                    <div class="ab-skill-bars">
                        @foreach ($skills as $skill)
                            @if (! empty($skill['label']))
                                @php
                                    $pct = trim((string) ($skill['pct'] ?? ''));
                                    $pctValue = rtrim($pct, '%');
                                @endphp
                                <div class="ab-skill-bar">
                                    <div class="ab-skill-bar-header">
                                        <span class="ab-skill-bar-label">{{ $skill['label'] }}</span>
                                        <span class="ab-skill-bar-pct">{{ $pctValue ?: '0' }}<span class="ab-skill-bar-pct-sign">%</span></span>
                                    </div>
                                    <div class="ab-skill-bar-track">
                                        <div class="ab-skill-bar-fill" data-width="{{ $pctValue ?: 0 }}%"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
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

</div>{{-- /.ab-container --}}
</div>{{-- /.ab-page --}}

<script>
/* ── Neural Brain-Cell Canvas Background ── */
(function () {
    const canvas = document.getElementById('ab-neural-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    const GOLD  = { r: 200, g: 169, b: 110 };
    const CREAM = { r: 240, g: 236, b: 228 };

    const NUM_NODES = 70;
    const nodes = [];

    /* ── Nodes store RELATIVE positions (0–1) so they always
       spread across the full canvas after any resize ── */
    for (let i = 0; i < NUM_NODES; i++) {
        const isBig = Math.random() < 0.14;
        nodes.push({
            rx:          Math.random(),
            ry:          Math.random(),
            vx:          (Math.random() - 0.5) * 0.00035,
            vy:          (Math.random() - 0.5) * 0.00035,
            radius:      isBig ? (3.5 + Math.random() * 3) : (1 + Math.random() * 2),
            pulseOffset: Math.random() * Math.PI * 2,
            pulseSpeed:  0.010 + Math.random() * 0.016,
            isGold:      Math.random() < 0.42,
            isBig,
            halo:        isBig && Math.random() < 0.65,
        });
    }

    /* Resize: update canvas dimensions; nodes auto-adapt via rx/ry */
    function resize() {
        const hero    = canvas.closest('.ab-hero');
        canvas.width  = hero.offsetWidth;
        canvas.height = hero.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    let frame = 0;

    function draw() {
        frame++;
        const W = canvas.width;
        const H = canvas.height;
        ctx.clearRect(0, 0, W, H);

        const MAX_DIST = Math.min(W, H) * 0.22;

        /* Move nodes in relative space and wrap */
        for (const n of nodes) {
            n.rx += n.vx;
            n.ry += n.vy;
            if (n.rx < -0.05) n.rx = 1.05;
            if (n.rx > 1.05)  n.rx = -0.05;
            if (n.ry < -0.05) n.ry = 1.05;
            if (n.ry > 1.05)  n.ry = -0.05;
        }

        /* Convert to pixel coords for drawing */
        const px = nodes.map(n => ({ x: n.rx * W, y: n.ry * H, n }));

        /* Draw curved synaptic connections */
        for (let i = 0; i < px.length; i++) {
            for (let j = i + 1; j < px.length; j++) {
                const a = px[i], b = px[j];
                const dx = a.x - b.x, dy = a.y - b.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < MAX_DIST) {
                    const alpha = (1 - dist / MAX_DIST) * 0.16;
                    const bothGold = a.n.isGold && b.n.isGold;
                    const c = bothGold ? GOLD : CREAM;
                    const bend = ((i * 31 + j * 17) % 24) - 12;
                    const mx = (a.x + b.x) / 2 - (dy / dist) * bend;
                    const my = (a.y + b.y) / 2 + (dx / dist) * bend;
                    ctx.beginPath();
                    ctx.moveTo(a.x, a.y);
                    ctx.quadraticCurveTo(mx, my, b.x, b.y);
                    ctx.strokeStyle = `rgba(${c.r},${c.g},${c.b},${alpha})`;
                    ctx.lineWidth   = bothGold ? 0.85 : 0.4;
                    ctx.stroke();
                }
            }
        }

        /* Draw nodes */
        for (let i = 0; i < px.length; i++) {
            const { x, y, n } = px[i];
            const pulse = Math.sin(frame * n.pulseSpeed + n.pulseOffset);
            const r     = n.radius + pulse * 0.7;
            const c     = n.isGold ? GOLD : CREAM;
            const alpha = 0.5 + pulse * 0.35;

            if (n.halo) {
                const grad = ctx.createRadialGradient(x, y, r * 0.5, x, y, r * 6);
                grad.addColorStop(0, `rgba(${c.r},${c.g},${c.b},0.15)`);
                grad.addColorStop(1, `rgba(${c.r},${c.g},${c.b},0)`);
                ctx.beginPath();
                ctx.arc(x, y, r * 6, 0, Math.PI * 2);
                ctx.fillStyle = grad;
                ctx.fill();
            }

            ctx.beginPath();
            ctx.arc(x, y, r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${c.r},${c.g},${c.b},${alpha})`;
            ctx.fill();

            if (n.isBig) {
                ctx.beginPath();
                ctx.arc(x, y, r + 2.5, 0, Math.PI * 2);
                ctx.strokeStyle = `rgba(${c.r},${c.g},${c.b},0.22)`;
                ctx.lineWidth   = 1;
                ctx.stroke();
            }
        }

        requestAnimationFrame(draw);
    }

    draw();
})();
</script>

<script>
/* ── Animate skill bars when they scroll into view ── */
(function () {
    const fills = document.querySelectorAll('.ab-skill-bar-fill');
    if (!fills.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const idx = [...fills].indexOf(el);
                setTimeout(() => {
                    el.style.width = el.dataset.width || '0%';
                }, idx * 120);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.25 });

    fills.forEach(fill => observer.observe(fill));

    /* Animated percentage counter */
    const pcts = document.querySelectorAll('.ab-skill-bar-pct');
    const pctObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el   = entry.target;
                const sign = el.querySelector('.ab-skill-bar-pct-sign');
                const end  = parseInt(el.textContent, 10) || 0;
                const dur  = 1200;
                const step = 16;
                const steps = Math.round(dur / step);
                let current = 0;
                const inc   = end / steps;
                const timer = setInterval(() => {
                    current += inc;
                    if (current >= end) { current = end; clearInterval(timer); }
                    el.textContent = Math.round(current);
                    if (sign) el.appendChild(sign);
                }, step);
                pctObserver.unobserve(el);
            }
        });
    }, { threshold: 0.3 });

    pcts.forEach(p => pctObserver.observe(p));
})();
</script>

@endsection