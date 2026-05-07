<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Outfit:wght@300;400;500;600&display=swap');

    .pf-header {
        position: sticky; top: 0; z-index: 50;
        font-family: 'Outfit', sans-serif;
        background: rgba(11,12,14,.85);
        border-bottom: 1px solid rgba(255,255,255,.07);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    /* Subtle bottom accent line */
    .pf-header-rule {
        position: absolute; bottom: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(200,169,110,.18), transparent);
        pointer-events: none;
    }

    .pf-header-inner {
        max-width: 1200px; margin: 0 auto;
        padding: 0 48px;
        height: 72px;
        display: flex; align-items: center;
        justify-content: space-between;
        position: relative;
    }

    /* ── LOGO ── */
    .pf-header-logo {
        display: flex; align-items: center;
        gap: 13px; text-decoration: none;
    }

    .pf-header-monogram {
        width: 40px; height: 40px;
        border: 1px solid rgba(200,169,110,.4);
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 14px; font-weight: 600;
        color: #c8a96e;
        letter-spacing: -1px;
        background: rgba(200,169,110,.06);
        transition: border-color .25s, background .25s;
    }

    .pf-header-logo:hover .pf-header-monogram {
        border-color: rgba(200,169,110,.7);
        background: rgba(200,169,110,.1);
    }

    .pf-header-logo-text { line-height: 1; }

    .pf-header-logo-name {
        font-weight: 600; font-size: 14px;
        color: #f0ece4; letter-spacing: 0.2px;
        display: block;
    }

    .pf-header-logo-role {
        font-size: 10px; color: rgba(200,169,110,.7);
        letter-spacing: 1.2px; text-transform: uppercase;
        display: block; margin-top: 2px;
    }

    /* ── NAV LINKS ── */
    .pf-header-nav {
        display: flex; align-items: center; gap: 2px;
        margin-left: auto;
        padding-right: 0;
    }

    .pf-header-nav a {
        font-size: 12px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: rgba(240,236,228,.5);
        text-decoration: none; padding: 8px 16px;
        border-radius: 8px;
        transition: color .2s, background .2s;
        position: relative;
    }

    .pf-header-nav a:hover {
        color: #f0ece4;
        background: rgba(255,255,255,.04);
    }

    .pf-header-nav a.active {
        color: #c8a96e;
    }

    /* ── RIGHT ACTIONS ── */
    .pf-header-actions { display: flex; align-items: center; gap: 12px; }

    /* ── MOBILE TOGGLE ── */
    .pf-header-hamburger {
        display: none;
        background: none; border: 1px solid rgba(255,255,255,.07);
        border-radius: 8px; padding: 8px 10px;
        color: rgba(240,236,228,.6); cursor: pointer;
        transition: border-color .2s, color .2s;
    }
    .pf-header-hamburger:hover {
        border-color: rgba(200,169,110,.3);
        color: #c8a96e;
    }

    /* ── MOBILE MENU ── */
    .pf-mobile-menu {
        display: none;
        background: rgba(17,19,22,.97);
        border-top: 1px solid rgba(255,255,255,.07);
        backdrop-filter: blur(20px);
    }

    .pf-mobile-menu.open { display: block; }

    .pf-mobile-menu-inner {
        max-width: 1200px; margin: 0 auto;
        padding: 20px 48px 28px;
        display: flex; flex-direction: column; gap: 4px;
    }

    .pf-mobile-menu a.pf-mobile-link {
        font-size: 12px; font-weight: 500;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: rgba(240,236,228,.5);
        text-decoration: none; padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,.04);
        transition: color .2s, padding-left .2s;
        display: flex; align-items: center; gap: 10px;
    }

    .pf-mobile-menu a.pf-mobile-link::before {
        content: ''; display: block;
        width: 16px; height: 1px;
        background: #c8a96e; opacity: 0;
        transition: opacity .2s;
        flex-shrink: 0;
    }

    .pf-mobile-menu a.pf-mobile-link:hover {
        color: #f0ece4;
        padding-left: 4px;
    }

    .pf-mobile-menu a.pf-mobile-link:hover::before { opacity: .5; }

    .pf-mobile-admin-wrap { display: none; }

    @media (max-width: 900px) {
        .pf-header-nav { display: none; }
        .pf-header-hamburger { display: flex; align-items: center; }
        .pf-header-inner { padding: 0 24px; }
        .pf-mobile-menu-inner { padding: 20px 24px 28px; }
    }
</style>

<header class="pf-header">
    <div class="pf-header-rule"></div>

    <div class="pf-header-inner">

        {{-- Logo --}}
        <a href="/" class="pf-header-logo">
            <div class="pf-header-monogram">IKA</div>
            <div class="pf-header-logo-text">
                <span class="pf-header-logo-name">Ivan Kim Almadin</span>
                <span class="pf-header-logo-role">Creative Portfolio</span>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <nav class="pf-header-nav">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
            <a href="/portfolio" class="{{ request()->is('portfolio*') ? 'active' : '' }}">Projects</a>
            <a href="/services" class="{{ request()->is('services*') ? 'active' : '' }}">Services</a>
            <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        </nav>

        {{-- Actions --}}
        <div class="pf-header-actions">
            {{-- Mobile toggle --}}
            <button class="pf-header-hamburger" id="pf-hamburger" aria-label="Toggle menu">
                <svg id="pf-icon-open" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="pf-icon-close" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    </div>
</header>

{{-- Mobile Menu --}}
<div class="pf-mobile-menu" id="pf-mobile-menu">
    <div class="pf-mobile-menu-inner">
        <a href="/" class="pf-mobile-link">Home</a>
        <a href="/about" class="pf-mobile-link">About</a>
        <a href="/portfolio" class="pf-mobile-link">Projects</a>
        <a href="/services" class="pf-mobile-link">Services</a>
        <a href="/contact" class="pf-mobile-link">Contact</a>
    </div>
</div>

<script>
    (function () {
        const btn       = document.getElementById('pf-hamburger');
        const menu      = document.getElementById('pf-mobile-menu');
        const iconOpen  = document.getElementById('pf-icon-open');
        const iconClose = document.getElementById('pf-icon-close');

        btn.addEventListener('click', () => {
            const isOpen = menu.classList.toggle('open');
            iconOpen.style.display  = isOpen ? 'none'  : 'block';
            iconClose.style.display = isOpen ? 'block' : 'none';
        });
    })();
</script>