
<link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
<header class="pf-header">
    <div class="pf-header-rule"></div>

    <div class="pf-header-inner">

        {{-- Logo --}}
        <a href="/" class="pf-header-logo">
            <div class="pf-header-monogram">IKA</div>
            <div class="pf-header-logo-text">
                <span class="pf-header-logo-name">Ivan Kim Almadin</span>
                <span class="pf-header-logo-role">My Portfolio</span>
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