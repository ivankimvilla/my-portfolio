@props(['copyright' => '© 2025 Ivan Kim Almadin. All rights reserved.'])
<footer class="site-footer">
  <div class="footer-grid">
    <div class="footer-identity">
      <a class="footer-monogram" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home">IK</a>
      <div class="footer-signature">
        <strong>Ivan Kim Almadin</strong>
        <span class="footer-rule" aria-hidden="true"></span>
        <span class="footer-description">Full Stack Developer &amp; UI/UX Designer</span>
      </div>
    </div>
    <nav class="footer-page-links" aria-label="Footer navigation">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('about') }}">About Me</a>
      <a href="{{ route('works') }}">Works</a>
    </nav>
    <div class="footer-meta">
      <div class="footer-social-links">
        <a href="https://github.com/" aria-label="GitHub"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.9a3.4 3.4 0 0 0-.9-2.6c3.1-.4 6.4-1.5 6.4-7A5.4 5.4 0 0 0 20 4.8 5 5 0 0 0 19.9 1S18.7.7 16 2.5a13.4 13.4 0 0 0-7 0C6.3.7 5.1 1 5.1 1A5 5 0 0 0 5 4.8a5.4 5.4 0 0 0-1.5 3.8c0 5.4 3.3 6.6 6.4 7A3.4 3.4 0 0 0 9 18.1V22"/></svg></a>
        <a class="footer-linkedin" href="https://www.linkedin.com/" aria-label="LinkedIn">in</a>
        <a href="mailto:almadinivan12@gmail.com" aria-label="Email"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 7L2 7"/></svg></a>
      </div>
      <span class="footer-copyright">{{ $copyright }}</span>
    </div>
  </div>
</footer>
