@props(['copyright' => '© 2025 Ivan Kim Almadin. All rights reserved.'])
<footer class="site-footer">
  <section class="home-contact-section" id="contact" aria-labelledby="contact-title">
    <div class="contact-landscape" aria-hidden="true"></div>
    <div class="contact-shell">
      <header class="contact-intro">
        <h2 id="contact-title">Get in touch.</h2>
        <p>Have a project in mind, a question, or just want to say hi?<br>Feel free to reach out. I’d love to hear from you.</p>
      </header>

      <div class="contact-panel" aria-label="Contact methods">
        <div class="contact-methods">
          <article class="contact-method">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 7L2 7"/></svg>
            <h4>Email</h4>
            <a href="mailto:almadinivan12@gmail.com">almadinivan12@gmail.com</a>
          </article>

          <article class="contact-method">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.7L7.1 10a16 16 0 0 0 6 6l1.6-1.9a2 2 0 0 1 1.7-.6l3 .5a2 2 0 0 1 1.6 1.9Z"/></svg>
            <h4>Phone</h4>
            <span>+63 953 578 6765</span>
          </article>

          <article class="contact-method">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <h4>Location</h4>
            <span>Davao City, Philippines</span>
          </article>
        </div>
      </div>
    </div>
  </section>

  <div class="footer-bottom-bar">
    <div class="footer-brand">
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
