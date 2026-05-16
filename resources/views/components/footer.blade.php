
<link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">

<footer class="pf-footer">
    <div class="pf-footer-rule"></div>

    <div class="pf-footer-inner">

        {{-- ── MAIN GRID ── --}}
        <div class="pf-footer-grid">

            {{-- Brand --}}
            <div>
                <div class="pf-footer-brand-monogram">IKA</div>
                <div class="pf-footer-brand-name">Ivan Kim Almadin</div>
                <div class="pf-footer-brand-role">Full-Stack Developer</div>
                <p class="pf-footer-brand-desc">
                    Building elegant, scalable digital experiences that solve real problems and drive meaningful impact.
                </p>
                <div class="pf-footer-socials">
                    <a href="https://github.com/ivankimvilla" target="_blank" rel="noopener" class="pf-footer-social"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/ivan-kim-almadin-483b16408" target="_blank" rel="noopener" class="pf-footer-social"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://x.com/AlmadinIvan" target="_blank" rel="noopener" class="pf-footer-social"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            {{-- Pages --}}
            <div>
                <div class="pf-footer-col-title">Pages</div>
                <ul class="pf-footer-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/portfolio">Projects</a></li>
                    <li><a href="/services">Services</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <div class="pf-footer-col-title">Services</div>
                <ul class="pf-footer-links">
                    <li><a href="/services">Web Development</a></li>
                    <li><a href="/services">UI/UX Design</a></li>
                    <li><a href="/services">Responsive Website Design</a></li>
                    <li><a href="/services">API Development</a></li>
                    <li><a href="/services">E-Commerce Website Development</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <div class="pf-footer-col-title">Get In Touch</div>
                <ul class="pf-footer-contact-list">
                    <li class="pf-footer-contact-item">
                        <div class="pf-footer-contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="pf-footer-contact-label">Email</div>
                            <div class="pf-footer-contact-value">ivanalmadin0@gmail.com</div>
                        </div>
                    </li>
                    <li class="pf-footer-contact-item">
                        <div class="pf-footer-contact-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="pf-footer-contact-label">Phone</div>
                            <div class="pf-footer-contact-value">+63 (953) 578-6765</div>
                        </div>
                    </li>
                    <li class="pf-footer-contact-item">
                        <div class="pf-footer-contact-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <div class="pf-footer-contact-label">Availability</div>
                            <div class="pf-footer-contact-value">Monday–Friday, 8:00 AM–6:00 PM PHT</div>
                        </div>
                    </li>
                    <li class="pf-footer-contact-item">
                        <div class="pf-footer-contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="pf-footer-contact-label">Location</div>
                            <div class="pf-footer-contact-value">Philippines</div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        {{-- ── BOTTOM BAR ── --}}
        <div class="pf-footer-bottom">
            <span class="pf-footer-copy">
                <span style="color: var(--accent, #c8a96e);">&copy;</span> 2026 <span style="color: var(--accent, #c8a96e);">Ivan Kim Almadin</span>. All rights reserved.
            </span>

        </div>

    </div>
</footer>