@extends('layouts.app')

@section('title', 'Ivan Kim Almadin - Full Stack Developer')

@section('content')


<link rel="stylesheet" href="{{ asset('css/home/home.css') }}">

<div class="pf-home">

    {{-- ══ HERO ══ --}}
    <section class="pf-hero">
        <canvas id="pf-neural-canvas"></canvas>
        <div class="pf-hero-rule pf-hero-rule-top"></div>
        <div class="pf-hero-rule pf-hero-rule-bottom"></div>

        <div class="pf-container">
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
        </div>{{-- /.pf-container --}}
    </section>

<div class="pf-container">
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

    {{-- ══ TESTIMONIALS ══ --}}
    <section id="testimonials" class="pf-testimonials">
        <div class="pf-eyebrow">Client Feedback</div>
        <h2 class="pf-section-title">Trusted <em>Testimonials.</em></h2>
        <p class="pf-section-desc">
            Real client feedback from projects that delivered strong results.
        </p>

        <div class="pf-divider">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="pf-testimonials-layout">

            {{-- LEFT: cards column --}}
            <div class="pf-testimonials-cards-col">
                <div class="pf-testimonials-grid">
                    @forelse($testimonials->take(5) as $testimonial)
                        <article class="pf-testimonial-card">

                            {{-- 1. Stars — top ── --}}
                            <div class="pf-testimonial-rating">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <span>★</span>
                                @endfor
                                @for($i = $testimonial->rating; $i < 5; $i++)
                                    <span style="color:rgba(255,255,255,.15);">★</span>
                                @endfor
                            </div>

                            {{-- 2. Author row: avatar + info ── --}}
                            <div class="pf-testimonial-author">
                                @if($testimonial->client_image)
                                    <img src="{{ $testimonial->client_image }}" alt="{{ $testimonial->client_name }}" class="pf-testimonial-avatar object-cover">
                                @else
                                    <div class="pf-testimonial-avatar">{{ strtoupper(substr($testimonial->client_name, 0, 1)) }}</div>
                                @endif

                                <div class="pf-testimonial-author-info">
                                    <div class="pf-testimonial-author-name">{{ $testimonial->client_name }}</div>
                                    <div class="pf-testimonial-author-meta">
                                        {{ $testimonial->client_title }}{{ $testimonial->client_title && $testimonial->client_company ? ' at ' : '' }}{{ $testimonial->client_company }}
                                    </div>
                                    @if($testimonial->project_url)
                                        <a href="{{ $testimonial->project_url }}" class="pf-testimonial-link" target="_blank" rel="noopener">
                                            View client project <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- 3. Quote — bottom ── --}}
                            <p class="pf-testimonial-quote">"{{ $testimonial->content }}"</p>

                        </article>
                    @empty
                        <div class="pf-projects-empty">
                            <i class="fas fa-comments"></i>
                            <p>Client testimonials coming soon.</p>
                        </div>
                    @endforelse
                </div>

                @if(!empty($hasMoreTestimonials))
                    <div style="margin-top: auto; padding-top: 24px; text-align: center;">
                        <a href="{{ route('testimonials.index') }}" class="pf-btn-primary" style="display:inline-flex; justify-content:center;">
                            View all
                        </a>
                    </div>
                @endif
            </div>

            {{-- RIGHT: form column (sticky) --}}
            <div class="pf-testimonials-form-col">
                <div class="pf-testimonials-form-sticky">
                    <div class="pf-testimonials-form-heading">
                        <div class="pf-testimonials-form-eyebrow">Share Your Experience</div>
                        <h3 class="pf-testimonials-form-title">Leave a <em>Review</em></h3>
                    </div>
                    <div id="testimonial-form-container">
                        <x-testimonial-form :showHeading="false" />
                    </div>
                </div>
            </div>

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
                    <li>React</li>
                    <li>Tailwind CSS</li>
                    <li>JavaScript</li>
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

        @php
            $defaultSkills = [
                ['label' => 'Backend Development', 'pct' => '95%'],
                ['label' => 'Frontend Development', 'pct' => '85%'],
                ['label' => 'Database Design', 'pct' => '90%'],
                ['label' => 'DevOps & Deployment', 'pct' => '80%'],
            ];
            $admin = \App\Models\User::where('is_admin', true)->first();
            $skills = $admin?->skills ?: $defaultSkills;
        @endphp

        <div class="pf-skill-bars-group">
            <div class="pf-skill-bars-header">
                <span class="pf-skill-bars-eyebrow">Proficiency</span>
                <h3 class="pf-skill-bars-title">Professional <em>Skills</em></h3>
            </div>
            <div class="pf-skill-bars-wrap">
                <div class="pf-skill-bars-list">
                    @foreach ($skills as $skill)
                        @if (! empty($skill['label']))
                            @php
                                $pct = trim((string) ($skill['pct'] ?? ''));
                                $pctValue = rtrim($pct, '%');
                            @endphp
                            <div class="pf-skill-bar">
                                <div class="pf-skill-bar-header">
                                    <span class="pf-skill-bar-label">{{ $skill['label'] }}</span>
                                    <span class="pf-skill-bar-pct">{{ $pctValue ?: '0' }}<span class="pf-skill-bar-pct-sign">%</span></span>
                                </div>
                                <div class="pf-skill-bar-track">
                                    <div class="pf-skill-bar-fill" data-width="{{ $pctValue ?: 0 }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
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
                @if($certificate->certificate_url)
                <div class="pf-certificate-image">
                    <a href="{{ $certificate->certificate_url }}" target="_blank" rel="noopener" class="pf-certificate-image-link">
                        <img src="{{ $certificate->certificate_url }}" alt="{{ $certificate->title }}" loading="lazy">
                    </a>
                </div>
            @else
                <div class="pf-certificate-image pf-certificate-image-placeholder">
                    <div class="pf-certificate-placeholder-inner">
                        <i class="fas fa-certificate"></i>
                        <span>No certificate image</span>
                    </div>
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

<script>
/* ── Neural Brain-Cell Canvas Background ── */
(function () {
    const canvas = document.getElementById('pf-neural-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    /* Color palette */
    const GOLD  = { r: 200, g: 169, b: 110 };
    const CREAM = { r: 240, g: 236, b: 228 };

    const NUM_NODES = 70;
    const nodes = [];

    /* ── Nodes store RELATIVE positions (0–1) so they always
       spread across the full canvas after any resize ── */
    for (let i = 0; i < NUM_NODES; i++) {
        const isBig = Math.random() < 0.14;
        nodes.push({
            rx:          Math.random(),          /* relative x: 0–1 */
            ry:          Math.random(),          /* relative y: 0–1 */
            vx:          (Math.random() - 0.5) * 0.00035,  /* velocity as fraction of W */
            vy:          (Math.random() - 0.5) * 0.00035,  /* velocity as fraction of H */
            radius:      isBig ? (3.5 + Math.random() * 3) : (1 + Math.random() * 2),
            pulseOffset: Math.random() * Math.PI * 2,
            pulseSpeed:  0.010 + Math.random() * 0.016,
            isGold:      Math.random() < 0.42,
            isBig,
            halo:        isBig && Math.random() < 0.65,
        });
    }

    /* Resize: update canvas dimensions; nodes auto-adapt via rx/ry.
       Falls back to window dimensions if the hero section is unavailable. */
    function resize() {
        const hero = canvas.closest('.pf-hero');
        canvas.width  = hero ? hero.offsetWidth  : window.innerWidth;
        canvas.height = hero ? hero.offsetHeight : window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    let frame = 0;
    let rafId = null;
    let running = true;

    function draw() {
        if (!running) return;
        frame++;
        const W = canvas.width;
        const H = canvas.height;
        ctx.clearRect(0, 0, W, H);

        /* Wider detection range so more nodes form connections */
        const MAX_DIST = Math.min(W, H) * 0.30;

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
                /* Guard: skip if nodes are at the same position (dist = 0)
                   to prevent NaN from dividing by zero in the bend calculation */
                if (dist < 1 || dist >= MAX_DIST) continue;
                /* Quadratic fade: bright near nodes, soft at the edge of range */
                const t     = 1 - dist / MAX_DIST;
                const alpha = t * t * 0.55;
                const bothGold = a.n.isGold && b.n.isGold;
                const c = bothGold ? GOLD : CREAM;
                const seed = (i * 31 + j * 17) & 0xFFFF;
                const bend = ((seed % 20) - 10);
                const mx = (a.x + b.x) / 2 - (dy / dist) * bend;
                const my = (a.y + b.y) / 2 + (dx / dist) * bend;
                ctx.beginPath();
                ctx.moveTo(a.x, a.y);
                ctx.quadraticCurveTo(mx, my, b.x, b.y);
                ctx.strokeStyle = `rgba(${c.r},${c.g},${c.b},${alpha})`;
                ctx.lineWidth   = bothGold ? 1.4 : 0.8;
                ctx.stroke();
            }
        }

        /* Draw nodes */
        for (let i = 0; i < px.length; i++) {
            const { x, y, n } = px[i];
            const pulse = Math.sin(frame * n.pulseSpeed + n.pulseOffset);
            const r     = n.radius + pulse * 1.0;
            const c     = n.isGold ? GOLD : CREAM;
            const alpha = 0.65 + pulse * 0.30;

            /* Soft halo glow — tighter and brighter */
            if (n.halo) {
                const grad = ctx.createRadialGradient(x, y, r * 0.4, x, y, r * 5.5);
                grad.addColorStop(0, `rgba(${c.r},${c.g},${c.b},0.25)`);
                grad.addColorStop(1, `rgba(${c.r},${c.g},${c.b},0)`);
                ctx.beginPath();
                ctx.arc(x, y, r * 5.5, 0, Math.PI * 2);
                ctx.fillStyle = grad;
                ctx.fill();
            }

            /* Core dot */
            ctx.beginPath();
            ctx.arc(x, y, r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${c.r},${c.g},${c.b},${alpha})`;
            ctx.fill();

            /* Outer ring for large nodes — more visible */
            if (n.isBig) {
                ctx.beginPath();
                ctx.arc(x, y, r + 3, 0, Math.PI * 2);
                ctx.strokeStyle = `rgba(${c.r},${c.g},${c.b},0.35)`;
                ctx.lineWidth   = 1.2;
                ctx.stroke();
            }
        }

        rafId = requestAnimationFrame(draw);
    }

    /* Cancel the loop if the canvas is removed from the DOM (e.g. SPA navigation)
       to prevent a memory-leaking zombie animation loop */
    const sentinel = new MutationObserver(() => {
        if (!document.body.contains(canvas)) {
            running = false;
            if (rafId) cancelAnimationFrame(rafId);
            sentinel.disconnect();
        }
    });
    sentinel.observe(document.body, { childList: true, subtree: true });

    draw();
})();
</script>

<script>
/* ── Animate skill bars when they scroll into view ── */
(function () {
    const fills = document.querySelectorAll('.pf-skill-bar-fill');
    if (!fills.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                /* stagger by index */
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
    const pcts = document.querySelectorAll('.pf-skill-bar-pct');
    const pctObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el   = entry.target;
                const sign = el.querySelector('.pf-skill-bar-pct-sign');
                /* Read the numeric value from the data attribute on the sibling
                   fill bar to avoid picking up the '%' character from textContent */
                const track = el.closest('.pf-skill-bar');
                const fill  = track ? track.querySelector('.pf-skill-bar-fill') : null;
                const end   = parseInt(fill ? fill.dataset.width : el.textContent, 10) || 0;
                const dur   = 1200;
                const step  = 16;
                const steps = Math.round(dur / step);
                let current = 0;
                const inc   = end / steps;
                /* Create a dedicated text node for the number so the '%' sign
                   child element is never disturbed during the counter animation */
                const numNode = document.createTextNode('0');
                el.textContent = '';
                el.appendChild(numNode);
                if (sign) el.appendChild(sign);
                const timer = setInterval(() => {
                    current += inc;
                    if (current >= end) { current = end; clearInterval(timer); }
                    numNode.textContent = Math.round(current);
                }, step);
                pctObserver.unobserve(el);
            }
        });
    }, { threshold: 0.3 });

    pcts.forEach(p => pctObserver.observe(p));
})();
</script>

@endsection