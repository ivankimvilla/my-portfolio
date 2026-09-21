/*
 * project-card-neural.js
 * Renders the same animated neural / brain-cell canvas used in the hero
 * section inside empty project-card image placeholders.
 */

(function () {
    'use strict';

    const GOLD = { r: 200, g: 169, b: 110 };
    const CREAM = { r: 240, g: 236, b: 228 };

    function initCanvas(canvas) {
        const ctx = canvas.getContext('2d');
        const NUM_NODES = 28;
        const nodes = [];

        for (let i = 0; i < NUM_NODES; i++) {
            const isBig = Math.random() < 0.14;
            nodes.push({
                rx: Math.random(),
                ry: Math.random(),
                vx: (Math.random() - 0.5) * 0.00045,
                vy: (Math.random() - 0.5) * 0.00045,
                radius: isBig ? (3 + Math.random() * 2.5) : (1 + Math.random() * 1.8),
                pulseOffset: Math.random() * Math.PI * 2,
                pulseSpeed: 0.012 + Math.random() * 0.018,
                isGold: Math.random() < 0.42,
                isBig,
                halo: isBig && Math.random() < 0.65,
            });
        }

        function resize() {
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width || canvas.offsetWidth || 300;
            canvas.height = rect.height || canvas.offsetHeight || 220;
        }

        resize();

        let resizeTimer;
        const ro = new ResizeObserver(() => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(resize, 60);
        });
        ro.observe(canvas.parentElement || canvas);

        let frame = 0;
        let rafId = null;
        let running = true;

        function draw() {
            if (!running) return;
            frame++;
            const W = canvas.width;
            const H = canvas.height;
            ctx.clearRect(0, 0, W, H);

            const MAX_DIST = Math.min(W, H) * 0.42;

            for (const n of nodes) {
                n.rx += n.vx;
                n.ry += n.vy;
                if (n.rx < -0.05) n.rx = 1.05;
                if (n.rx > 1.05) n.rx = -0.05;
                if (n.ry < -0.05) n.ry = 1.05;
                if (n.ry > 1.05) n.ry = -0.05;
            }

            const px = nodes.map(n => ({ x: n.rx * W, y: n.ry * H, n }));

            for (let i = 0; i < px.length; i++) {
                for (let j = i + 1; j < px.length; j++) {
                    const a = px[i];
                    const b = px[j];
                    const dx = a.x - b.x;
                    const dy = a.y - b.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 1 || dist >= MAX_DIST) continue;

                    const t = 1 - dist / MAX_DIST;
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
                    ctx.lineWidth = bothGold ? 1.2 : 0.7;
                    ctx.stroke();
                }
            }

            for (let i = 0; i < px.length; i++) {
                const { x, y, n } = px[i];
                const pulse = Math.sin(frame * n.pulseSpeed + n.pulseOffset);
                const r = n.radius + pulse * 0.9;
                const c = n.isGold ? GOLD : CREAM;
                const alpha = 0.60 + pulse * 0.30;

                if (n.halo) {
                    const grad = ctx.createRadialGradient(x, y, r * 0.4, x, y, r * 5);
                    grad.addColorStop(0, `rgba(${c.r},${c.g},${c.b},0.22)`);
                    grad.addColorStop(1, `rgba(${c.r},${c.g},${c.b},0)`);
                    ctx.beginPath();
                    ctx.arc(x, y, r * 5, 0, Math.PI * 2);
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
                    ctx.strokeStyle = `rgba(${c.r},${c.g},${c.b},0.30)`;
                    ctx.lineWidth = 1;
                    ctx.stroke();
                }
            }

            rafId = requestAnimationFrame(draw);
        }

        const sentinel = new MutationObserver(() => {
            if (!document.body.contains(canvas)) {
                running = false;
                if (rafId) cancelAnimationFrame(rafId);
                sentinel.disconnect();
                ro.disconnect();
            }
        });
        sentinel.observe(document.body, { childList: true, subtree: true });

        draw();
    }

    function boot() {
        document.querySelectorAll('.pc-image-neural-canvas').forEach(canvas => {
            if (!canvas.dataset.pfInit) {
                canvas.dataset.pfInit = '1';
                initCanvas(canvas);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

    const globalObserver = new MutationObserver(() => {
        document.querySelectorAll('.pc-image-neural-canvas:not([data-pf-init])').forEach(canvas => {
            canvas.dataset.pfInit = '1';
            initCanvas(canvas);
        });
    });
    globalObserver.observe(document.body, { childList: true, subtree: true });
})();
