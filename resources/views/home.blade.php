@extends('layouts.app')

@section('title', 'Ivan Kim Almadin')

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
                    Hi, I'm
                    <span class="pf-hero-name-line"><em>Ivan Kim</em> Almadin.</span>
                </h1>

                <p class="pf-hero-desc">
                    A Full-Stack Web Developer focused on building elegant and scalable solutions for complex problems, specializing in modern web applications and impactful digital experiences.
                </p>

                <div class="pf-hero-actions">
                    <a href="#contact" class="pf-btn-primary">
                        <span>Start a Project</span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>
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