@php
    $details = [
        ['Location', 'Davao City, Philippines', null, '<path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/>'],
        ['Email', 'almadinivan12@gmail.com', 'mailto:almadinivan12@gmail.com', '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/>'],
        ['Phone', '+63 953 578 6765', null, '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.7L7.1 10a16 16 0 0 0 6 6l1.6-1.9a2 2 0 0 1 1.7-.6l3 .5a2 2 0 0 1 1.6 1.9Z"/>'],
        ['Availability', 'Open to work', null, '<path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/>'],
    ];

    $symbols = [
        'shield' => '<path d="M12 3 19 6v5c0 4.6-3 8-7 10-4-2-7-5.4-7-10V6l7-3Z"/><path d="m9 12 2 2 4-4"/>',
        'code' => '<path d="m8 7-5 5 5 5M16 7l5 5-5 5m-3-12-2 12"/>',
        'file' => '<path d="M6 3h8l5 5v13H6zM14 3v6h5M9 13h7m-7 4h7"/>',
        'gear' => '<circle cx="12" cy="12" r="3"/><path d="m19.4 15 .1.1 1.2 1-1.5 2.6-1.5-.5-.2.1-1 .6-.3 1.6h-3l-.3-1.6-1.2-.7-1.5.5-1.5-2.6 1.2-1-.1-1.4-1.2-1 1.5-2.6 1.5.5 1.2-.7.3-1.6h3l.3 1.6 1.2.7 1.5-.5 1.5 2.6-1.2 1Z"/>',
        'nodes' => '<rect x="3" y="4" width="7" height="6" rx="1"/><rect x="14" y="14" width="7" height="6" rx="1"/><path d="M10 7h3a3 3 0 0 1 3 3v4M7 10v4a3 3 0 0 0 3 3h4"/>',
        'triangle' => '<path d="M10.3 4.8a2 2 0 0 1 3.4 0l7.1 12.3a2 2 0 0 1-1.7 3H4.6a2 2 0 0 1-1.7-3l7.4-12.3Z"/><path d="M12 9v5m0 3h.01"/>',
    ];

    $skillGroups = [
        ['Frontend', '<rect x="3" y="4" width="18" height="16" rx="1"/><path d="M3 9h18M8 9v11"/>', [['HTML5', 'shield'], ['CSS3', 'code'], ['JavaScript', 'file']]],
        ['Backend', '<rect x="4" y="3" width="16" height="7" rx="1"/><rect x="4" y="14" width="16" height="7" rx="1"/><path d="M8 6.5h.01M8 17.5h.01"/>', [['PHP', 'shield'], ['Laravel', 'code'], ['MySQL', 'file'], ['REST API', 'triangle']]],
        ['UI/UX Design', '<path d="M12 3h4a3 3 0 0 1 0 6h-4V3Zm0 6h4a3 3 0 0 1 0 6h-4V9Zm0 6h4a3 3 0 1 1-3 3v-3Zm0-12H8a3 3 0 0 0 0 6h4V3Zm0 6H8a3 3 0 0 0 0 6h4V9Zm0 6H9a3 3 0 1 0 3 3v-3Z"/>', [['Figma', 'shield'], ['Adobe Photoshop', 'code'], ['Adobe Illustrator', 'file'], ['Wireframing', 'gear'], ['Prototyping', 'nodes']]],
        ['Tools & Others', '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="m7 9 3 3-3 3m6 0h4"/>', [['Git', 'shield'], ['GitHub', 'code'], ['VS Code', 'file'], ['Figma', 'triangle']]],
        ['AI / AI-Assisted Development', '<path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5m-18 5 9 4.5 9-4.5"/>', [['ChatGPT', 'shield'], ['Cursor', 'code'], ['GitHub Copilot', 'file'], ['Claude', 'gear'], ['AI Automation', 'nodes'], ['Prompt Engineering', 'triangle']]],
    ];

    $experience = [
        ['2026-07', 'July 2026 – September 2026', 'AIZAP CREATIVES', 'Developed custom web applications and responsive interfaces for live client projects.'],
        ['2026-06', 'June 2026 – August 2026', 'ENSO AI', 'Created and optimized prompts and visual inputs for AI video generation.'],
        ['2025-07', 'July 2025 – April 2026', 'RYPACI IT SOLUTIONS', 'Developed full-stack web applications and custom tools to improve daily business workflows.'],
    ];

    $approach = ['Clean and maintainable code', 'User-centered design', 'Effective communication', 'Continuous learning', 'Delivering practical value'];
@endphp

<x-layouts.portfolio title="About Me — Ivan Kim Almadin" page-css="css/pages/about.css" page-js="js/pages/about.js" active="about" body-class="portfolio-about">
<main id="about">
  <section class="about-biography">
    <div class="about-content-width">
      <div class="about-profile">
        <figure class="about-photo"><img src="{{ asset('image/home-hero.png') }}" alt="Portrait of Ivan Kim Almadin" fetchpriority="high"></figure>
        <div class="about-profile-copy">
          <p class="about-greeting" style="--i:0">Hello, I'm</p>
          <h1 style="--i:1">Ivan Kim Almadin</h1>
          <p class="about-role" style="--i:2">Full Stack Developer &amp; UI/UX Designer</p>
          <p class="about-description" style="--i:3">I'm an IT graduate with experience in full-stack web development, AI integration, and AI agent pipelines. I enjoy building modern web applications and creating user-friendly designs that solve real problems.</p>
          <p class="about-description" style="--i:4">I use modern technologies and AI tools to work efficiently, learn quickly, and deliver useful results.</p>
        </div>
      </div>

      <div class="about-details" aria-label="Personal details">
        @foreach ($details as $index => [$label, $value, $href, $icon])
          <article style="--i:{{ $index }}">
            <svg viewBox="0 0 24 24" aria-hidden="true">{!! $icon !!}</svg>
            <div>
              <span>{{ $label }}</span>
              @if ($href)<a href="{{ $href }}">{{ $value }}</a>@else<strong>{{ $value }}</strong>@endif
            </div>
          </article>
        @endforeach
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
        @foreach ($symbols as $name => $paths)
          <symbol id="about-skill-{{ $name }}" viewBox="0 0 24 24">{!! $paths !!}</symbol>
        @endforeach
      </svg>

      <div class="about-skill-grid">
        @foreach ($skillGroups as [$groupTitle, $groupIcon, $skills])
          <article class="about-skill-card reveal">
            <div class="about-skill-heading">
              <svg viewBox="0 0 24 24" aria-hidden="true">{!! $groupIcon !!}</svg>
              <h3>{{ $groupTitle }}</h3>
            </div>
            <ul>
              @foreach ($skills as [$skill, $symbol])
                <li><svg aria-hidden="true"><use href="#about-skill-{{ $symbol }}"/></svg><span>{{ $skill }}</span></li>
              @endforeach
            </ul>
          </article>
        @endforeach
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
        @foreach ($experience as [$datetime, $period, $company, $summary])
          <article class="about-experience-item reveal">
            <time datetime="{{ $datetime }}">{{ $period }}</time>
            <div><h3>{{ $company }}</h3><p>{{ $summary }}</p></div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <section class="about-bottom-section">
    <div class="about-content-width about-bottom-grid">
      <section class="reveal">
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

      <section class="about-approach reveal">
        <header class="about-section-heading">
          <h2>My Approach</h2>
          <p>How I work and what I value.</p>
        </header>
        <ul>
          @foreach ($approach as $item)<li>{{ $item }}</li>@endforeach
        </ul>
      </section>
    </div>
  </section>
</main>
</x-layouts.portfolio>