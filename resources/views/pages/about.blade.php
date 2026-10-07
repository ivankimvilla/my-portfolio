<x-layouts.portfolio title="About Me — Ivan Kim Almadin" page-css="css/pages/about.css" page-js="js/pages/about.js" active="about" body-class="portfolio-about">
<main class="about-page about-redesign" id="about">
  <section class="about-biography">
    <div class="about-content-width">
      <div class="about-profile about-reveal">
        <figure class="about-photo"><img src="{{ asset('image/home-hero.png') }}" alt="Portrait of Ivan Kim Almadin"></figure>
        <div class="about-profile-copy">
          <p class="about-greeting">Hello, I'm</p>
          <h1>Ivan Kim Almadin</h1>
          <p class="about-role">Full Stack Developer &amp; UI/UX Designer</p>
          <p class="about-description">I'm an IT graduate with experience in full-stack web development, AI integration, and AI agent pipelines. I enjoy building modern web applications and creating user-friendly designs that solve real problems.</p>
          <p class="about-description">I use modern technologies and AI tools to work efficiently, learn quickly, and deliver useful results.</p>
        </div>
      </div>

      <div class="about-details" aria-label="Personal details">
        <article>
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
          <div><span>Location</span><strong>Davao City, Philippines</strong></div>
        </article>
        <article>
          <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg>
          <div><span>Email</span><a href="mailto:almadinivan12@gmail.com">almadinivan12@gmail.com</a></div>
        </article>
        <article>
          <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="5" width="16" height="16" rx="2"/><path d="M8 3v4m8-4v4M4 10h16"/></svg>
          <div><span>Focus</span><strong>Full-Stack + AI</strong></div>
        </article>
        <article>
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg>
          <div><span>Availability</span><strong>Open to work</strong></div>
        </article>
      </div>
    </div>
  </section>

  <section class="about-skills-section">
    <div class="about-content-width">
      <header class="about-section-heading">
        <h2>Technical Skills</h2>
        <p>Tools and technologies I use to build useful products.</p>
      </header>
      <svg class="about-skill-icon-sprite" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
        <symbol id="about-skill-shield" viewBox="0 0 24 24"><path d="M12 3 19 6v5c0 4.6-3 8-7 10-4-2-7-5.4-7-10V6l7-3Z"/><path d="m9 12 2 2 4-4"/></symbol>
        <symbol id="about-skill-code" viewBox="0 0 24 24"><path d="m8 7-5 5 5 5M16 7l5 5-5 5m-3-12-2 12"/></symbol>
        <symbol id="about-skill-file" viewBox="0 0 24 24"><path d="M6 3h8l5 5v13H6zM14 3v6h5M9 13h7m-7 4h7"/></symbol>
        <symbol id="about-skill-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="m19.4 15 .1.1 1.2 1-1.5 2.6-1.5-.5-.2.1-1 .6-.3 1.6h-3l-.3-1.6-1.2-.7-1.5.5-1.5-2.6 1.2-1-.1-1.4-1.2-1 1.5-2.6 1.5.5 1.2-.7.3-1.6h3l.3 1.6 1.2.7 1.5-.5 1.5 2.6-1.2 1Z"/></symbol>
        <symbol id="about-skill-nodes" viewBox="0 0 24 24"><rect x="3" y="4" width="7" height="6" rx="1"/><rect x="14" y="14" width="7" height="6" rx="1"/><path d="M10 7h3a3 3 0 0 1 3 3v4M7 10v4a3 3 0 0 0 3 3h4"/></symbol>
        <symbol id="about-skill-triangle" viewBox="0 0 24 24"><path d="M10.3 4.8a2 2 0 0 1 3.4 0l7.1 12.3a2 2 0 0 1-1.7 3H4.6a2 2 0 0 1-1.7-3l7.4-12.3Z"/><path d="M12 9v5m0 3h.01"/></symbol>
      </svg>
      <div class="about-skill-grid">
        <article class="about-skill-card about-reveal">
          <div class="about-skill-heading"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="1"/><path d="M3 9h18M8 9v11"/></svg><h3>Frontend</h3></div>
          <ul><li><svg><use href="#about-skill-shield"/></svg><span>HTML5</span></li><li><svg><use href="#about-skill-code"/></svg><span>CSS3</span></li><li><svg><use href="#about-skill-file"/></svg><span>JavaScript</span></li></ul>
        </article>
        <article class="about-skill-card about-reveal">
          <div class="about-skill-heading"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="3" width="16" height="7" rx="1"/><rect x="4" y="14" width="16" height="7" rx="1"/><path d="M8 6.5h.01M8 17.5h.01"/></svg><h3>Backend</h3></div>
          <ul><li><svg><use href="#about-skill-shield"/></svg><span>PHP</span></li><li><svg><use href="#about-skill-code"/></svg><span>Laravel</span></li><li><svg><use href="#about-skill-file"/></svg><span>MySQL</span></li><li><svg><use href="#about-skill-triangle"/></svg><span>REST API</span></li></ul>
        </article>
        <article class="about-skill-card about-reveal">
          <div class="about-skill-heading"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3h4a3 3 0 0 1 0 6h-4V3Zm0 6h4a3 3 0 0 1 0 6h-4V9Zm0 6h4a3 3 0 1 1-3 3v-3Zm0-12H8a3 3 0 0 0 0 6h4V3Zm0 6H8a3 3 0 0 0 0 6h4V9Zm0 6H9a3 3 0 1 0 3 3v-3Z"/></svg><h3>UI/UX Design</h3></div>
          <ul><li><svg><use href="#about-skill-shield"/></svg><span>Figma</span></li><li><svg><use href="#about-skill-code"/></svg><span>Adobe Photoshop</span></li><li><svg><use href="#about-skill-file"/></svg><span>Adobe Illustrator</span></li><li><svg><use href="#about-skill-gear"/></svg><span>Wireframing</span></li><li><svg><use href="#about-skill-nodes"/></svg><span>Prototyping</span></li></ul>
        </article>
        <article class="about-skill-card about-reveal">
          <div class="about-skill-heading"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="m7 9 3 3-3 3m6 0h4"/></svg><h3>Tools &amp; Others</h3></div>
          <ul><li><svg><use href="#about-skill-shield"/></svg><span>Git</span></li><li><svg><use href="#about-skill-code"/></svg><span>GitHub</span></li><li><svg><use href="#about-skill-file"/></svg><span>VS Code</span></li><li><svg><use href="#about-skill-triangle"/></svg><span>Figma</span></li></ul>
        </article>
        <article class="about-skill-card about-reveal">
          <div class="about-skill-heading"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5m-18 5 9 4.5 9-4.5"/></svg><h3>AI / AI-Assisted Development</h3></div>
          <ul><li><svg><use href="#about-skill-shield"/></svg><span>ChatGPT</span></li><li><svg><use href="#about-skill-code"/></svg><span>Cursor</span></li><li><svg><use href="#about-skill-file"/></svg><span>GitHub Copilot</span></li><li><svg><use href="#about-skill-gear"/></svg><span>Claude</span></li><li><svg><use href="#about-skill-nodes"/></svg><span>AI Automation</span></li><li><svg><use href="#about-skill-triangle"/></svg><span>Prompt Engineering</span></li></ul>
        </article>
      </div>
    </div>
  </section>

  <section class="about-experience-section">
    <div class="about-content-width">
      <header class="about-section-heading">
        <h2>Work Experience</h2>
        <p>Where I've been and what I've worked on.</p>
      </header>
      <div class="about-experience-list">
        <article class="about-experience-item about-reveal">
          <time datetime="2026-07">July 2026 – September 2026</time>
          <div><h3>AIZAP CREATIVES</h3><p>Developed custom web applications and responsive interfaces for live client projects.</p></div>
        </article>
        <article class="about-experience-item about-reveal">
          <time datetime="2026-06">June 2026 – August 2026</time>
          <div><h3>ENSO AI</h3><p>Created and optimized prompts and visual inputs for AI video generation.</p></div>
        </article>
        <article class="about-experience-item about-reveal">
          <time datetime="2025-07">July 2025 – April 2026</time>
          <div><h3>RYPACI IT SOLUTIONS</h3><p>Developed full-stack web applications and custom tools to improve daily business workflows.</p></div>
        </article>
      </div>
    </div>
  </section>

  <section class="about-bottom-section">
    <div class="about-content-width about-bottom-grid">
      <section class="about-education about-reveal">
        <header class="about-section-heading">
          <h2>Education</h2>
          <p>My academic background.</p>
        </header>
        <div class="about-education-item">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c3.5 3 8.5 3 12 0v-5m4-2v6"/></svg>
          <div><strong>Bachelor of Science in Information Technology</strong><span>Assumption College of Davao</span></div>
        </div>
        <div class="about-education-item">
          <span class="about-education-mark" aria-hidden="true">+</span>
          <div><strong>UI/UX and NCII</strong><span>Assumption College of Davao · ACES Polytechnic College</span></div>
        </div>
      </section>
      <section class="about-approach about-reveal">
        <header class="about-section-heading">
          <h2>My Approach</h2>
          <p>How I work and what I value.</p>
        </header>
        <ul>
          <li>Clean and maintainable code</li>
          <li>User-centered design</li>
          <li>Effective communication</li>
          <li>Continuous learning</li>
          <li>Delivering practical value</li>
        </ul>
      </section>
    </div>
  </section>
</main>
</x-layouts.portfolio>