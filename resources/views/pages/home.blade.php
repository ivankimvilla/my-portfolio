<x-layouts.portfolio
  title="Ivan Kim Almadin — Portfolio"
  description="Ivan Kim Almadin is an IT graduate building full-stack web applications and AI-powered solutions."
  page-css="css/pages/home.css"
  page-js="js/pages/home.js"
  active="home"
  body-class="portfolio-home"
>
<main id="home">
  <section class="home-hero">
    <div class="container hero-inner">
      <div class="hero-copy">
        <span class="availability">Available for new projects</span>
        <p class="hero-greeting">Hello, I'm</p>
        <h1>Ivan Kim <span>Almadin</span></h1>
        <h2>Information Technology &amp; <span class="role-text" id="role-text">Full-Stack Development</span></h2>
        <p class="hero-description">IT graduate with strong experience in full-stack web development, AI integration, and AI agent pipelines. I build practical solutions that make work easier and more effective.</p>
        <div class="hero-actions"><a class="btn" href="{{ route('works') }}">View My Works <span aria-hidden="true">→</span></a><a class="hero-about-link" href="{{ route('about') }}">About Me</a></div>
      </div>
      <div class="hero-art"><img class="hero-portrait" src="{{ asset('image/home-hero.png') }}" alt="Portrait of Ivan Kim Almadin" /><span class="float-label float-one" aria-hidden="true">Figma</span><span class="float-label float-two" aria-hidden="true">Laravel</span><span class="float-label float-three" aria-hidden="true">UI/UX Design</span></div>
      <a class="scroll-cue" href="#selected-works" aria-label="Scroll to selected works"><i></i></a>
    </div>
  </section>

  <div class="marquee" aria-label="Skills"><div class="marquee-track">@foreach (['Full-Stack Development', 'HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'REST APIs', 'MySQL', 'AI Integration', 'AI Agents', 'Prompt Engineering', 'API Integration', 'Version Control', 'UI/UX'] as $skill)<span>{{ $skill }}</span>@endforeach @foreach (['Full-Stack Development', 'HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'REST APIs', 'MySQL', 'AI Integration', 'AI Agents', 'Prompt Engineering', 'API Integration', 'Version Control', 'UI/UX'] as $skill)<span aria-hidden="true">{{ $skill }}</span>@endforeach</div></div>

  <section class="home-profile-section" id="about-overview" aria-labelledby="profile-title">
    <div class="container profile-inner">
      <div class="profile-overview">
        <div class="profile-intro">
          <h2 id="profile-title">About Me</h2>
          <p>I'm a full-stack developer and UI/UX designer based in Davao City, Philippines. I create web solutions that are simple, functional, and built around real user needs.</p>
          <a class="profile-more" href="{{ route('about') }}">Get to Know Me<span aria-hidden="true">→</span></a>
        </div>
        <div class="profile-capabilities" aria-label="Core capabilities">
          <article class="profile-capability">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="13" rx="1.5"/><path d="M8 21h8M12 17v4"/></svg>
            <h3>Web Development</h3>
            <p>Responsive websites and scalable applications.</p>
          </article>
          <article class="profile-capability">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a9 9 0 1 0 0 18h1.2a2 2 0 0 0 1.5-3.3 1.8 1.8 0 0 1 1.4-3h.8A4.1 4.1 0 0 0 21 10.6C21 6.4 17 3 12 3Z"/><circle cx="7.5" cy="10" r="1"/><circle cx="11" cy="7" r="1"/><circle cx="16" cy="8" r="1"/></svg>
            <h3>UI/UX Design</h3>
            <p>Intuitive layouts shaped around people.</p>
          </article>
          <article class="profile-capability">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="5" r="2"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/><path d="M12 7v4m0 0H6v5m6-5h6v5m-6-5V9"/></svg>
            <h3>Problem Solving</h3>
            <p>Practical solutions for everyday challenges.</p>
          </article>
        </div>
      </div>

      <div class="profile-skills" aria-labelledby="profile-skills-title">
        <div class="profile-skills-heading">
          <h2 id="profile-skills-title">Skills</h2>
          <p>Technologies and tools I use to bring ideas to life.</p>
        </div>
        <div class="technology-grid">
          @foreach ([['Laravel', 'laravel'], ['PHP', 'php'], ['JavaScript', 'javascript'], ['HTML', 'html5'], ['CSS', 'css3'], ['AI', 'anthropic'], ['MySQL', 'mysql'], ['Figma', 'figma'], ['Git', 'git'], ['VS Code', 'vscode']] as $skill)
            <div class="technology-item">
              @if ($skill[1] === 'anthropic')
                <img src="https://cdn.simpleicons.org/anthropic" alt="Claude logo" loading="lazy" width="40" height="40">
              @else
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/{{ $skill[1] }}/{{ $skill[1] }}-original.svg" alt="" loading="lazy" width="40" height="40">
              @endif
              <span>{{ $skill[0] }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="home-section container" id="selected-works">
    <div class="section-heading"><div><h2>Sample Works</h2></div><a class="btn btn-light sample-works-link" href="{{ route('works') }}">View all works <span aria-hidden="true">→</span></a></div>
    <div class="home-work-grid" id="featured-grid"></div>
  </section>

  <section class="services-band"><div class="container">
    <div class="section-heading centered"><div><p class="eyebrow">WHAT I DO</p><h2>Design that works, code that lasts</h2></div></div>
    <div class="service-grid">
      <article class="service-card"><span class="service-icon">&lt;/&gt;</span><h3>Full-Stack Development</h3><p>Scalable web applications, from responsive frontends to PHP and Laravel backends, REST APIs, and MySQL databases.</p><b>01</b></article>
      <article class="service-card"><span class="service-icon">✳</span><h3>AI-Assisted Development</h3><p>I use AI tools and workflow automation to speed up development, solve technical challenges, and deliver reliable results.</p><b>02</b></article>
      <article class="service-card"><span class="service-icon">⌘</span><h3>Prompt Engineering</h3><p>I write clear, effective prompts that improve AI outputs and speed up development tasks.</p><b>03</b></article>
    </div>
  </div></section>

  <section class="home-contact-section" id="contact" aria-labelledby="contact-title">
    <div class="contact-landscape" aria-hidden="true"></div>
    <div class="contact-shell">
      <header class="contact-intro">
        <h2 id="contact-title">Get in touch.</h2>
        <p>Have a project in mind, a question, or just want to say hi?<br>Feel free to reach out. I’d love to hear from you.</p>
      </header>
      <div class="contact-intro-spacer" aria-hidden="true"></div>
      <section class="contact-panel" aria-label="Contact methods">
        <div class="contact-methods">
          <article class="contact-method">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 7L2 7"/></svg>
            <h4>Email</h4>
            <a href="mailto:almadinivan12@gmail.com">almadinivan12@gmail.com</a>
          </article>
          <article class="contact-method">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.7L7.1 10a16 16 0 0 0 6 6l1.6-1.9a2 2 0 0 1 1.7-.6l3 .5a2 2 0 0 1 1.6 1.9Z"/></svg>
            <h4>Phone</h4>
            <span>+63 9XX XXX XXXX</span>
          </article>
          <article class="contact-method">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <h4>Location</h4>
            <span>Davao City, Philippines</span>
          </article>
        </div>
      </section>
      <div class="contact-footer-spacer" aria-hidden="true"></div>
    </div>
  </section>

</main>
</x-layouts.portfolio>