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
                <h1 class="ab-hero-title">
                    I'm a
                    <span class="ab-hero-name-line"><em>Full-Stack</em> Developer.</span>
                </h1>

                <p class="ab-hero-desc">
                    IT graduate with strong experience in full-stack web development, AI integration, and AI agent pipelines.
                    Skilled at using AI and prompt engineering to work efficiently and solve technical challenges.
                </p>
                <p class="ab-hero-desc">
                    Passionate about creating practical solutions, helping businesses improve, and using technology to make work easier and more effective.
                </p>

                <div class="ab-hero-actions">
                    <a href="/portfolio" class="ab-btn-primary">
                        <span>View My Work</span><i style="margin-right:7px;"></i>
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

    /* Resize: falls back to window dimensions if hero section is unavailable */
    function resize() {
        const hero    = canvas.closest('.ab-hero');
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
                /* Guard against dist = 0 (division by zero → NaN control point) */
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
                /* Read numeric value from the sibling fill bar's data attribute
                   to avoid capturing the '%' character from textContent */
                const track = el.closest('.ab-skill-bar');
                const fill  = track ? track.querySelector('.ab-skill-bar-fill') : null;
                const end   = parseInt(fill ? fill.dataset.width : el.textContent, 10) || 0;
                const dur   = 1200;
                const step  = 16;
                const steps = Math.round(dur / step);
                let current = 0;
                const inc   = end / steps;
                /* Dedicated text node for the number so the '%' sign child
                   element is never disturbed during the counter animation */
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