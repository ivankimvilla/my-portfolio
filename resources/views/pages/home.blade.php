@php
    $marqueeSkills = ['Full-Stack Development', 'HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'REST APIs', 'MySQL', 'AI Integration', 'AI Agents', 'Prompt Engineering', 'API Integration', 'Version Control', 'UI/UX'];

    $technologies = [
        ['Laravel', 'laravel'], ['PHP', 'php'], ['JavaScript', 'javascript'], ['HTML', 'html5'], ['CSS', 'css3'],
        ['AI', 'anthropic'], ['MySQL', 'mysql'], ['Figma', 'figma'], ['Git', 'git'], ['VS Code', 'vscode'],
    ];

    $capabilities = [
        ['Web Development', 'Responsive websites and scalable applications.', '<rect x="3" y="4" width="18" height="13" rx="1.5"/><path d="M8 21h8M12 17v4"/>'],
        ['UI/UX Design', 'Intuitive layouts shaped around people.', '<path d="M12 3a9 9 0 1 0 0 18h1.2a2 2 0 0 0 1.5-3.3 1.8 1.8 0 0 1 1.4-3h.8A4.1 4.1 0 0 0 21 10.6C21 6.4 17 3 12 3Z"/><circle cx="7.5" cy="10" r="1"/><circle cx="11" cy="7" r="1"/><circle cx="16" cy="8" r="1"/>'],
        ['Problem Solving', 'Practical solutions for everyday challenges.', '<circle cx="12" cy="5" r="2"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/><path d="M12 7v4m0 0H6v5m6-5h6v5m-6-5V9"/>'],
    ];

    $services = [
        ['&lt;/&gt;', 'Full-Stack Development', 'Scalable web applications, from responsive frontends to PHP and Laravel backends, REST APIs, and MySQL databases.'],
        ['✳', 'AI-Assisted Development', 'I use AI tools and workflow automation to speed up development, solve technical challenges, and deliver reliable results.'],
        ['⌘', 'Prompt Engineering', 'I write clear, effective prompts that improve AI outputs and speed up development tasks.'],
    ];
@endphp

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
        <span class="availability" style="--i:0">Available for new projects</span>
        <p class="hero-greeting" style="--i:1">Hello, I'm</p>
        <h1 style="--i:2">Ivan Kim <span>Almadin</span></h1>
        <h2 style="--i:3">Information Technology &amp; <span class="role-text" id="role-text">Full-Stack Development</span></h2>
        <p class="hero-description" style="--i:4">IT graduate with strong experience in full-stack web development, AI integration, and AI agent pipelines. I build practical solutions that make work easier and more effective.</p>
        <div class="hero-actions" style="--i:5">
          <a class="btn" href="{{ route('works') }}">View My Works <span aria-hidden="true">→</span></a>
          <a class="hero-about-link" href="{{ route('about') }}">About Me</a>
        </div>
      </div>

      <div class="hero-art">
        <img class="hero-portrait" src="{{ asset('image/home-hero.png') }}" alt="Portrait of Ivan Kim Almadin" fetchpriority="high" />
        <span class="float-label float-one" aria-hidden="true">Figma</span>
        <span class="float-label float-two" aria-hidden="true">Laravel</span>
        <span class="float-label float-three" aria-hidden="true">UI/UX Design</span>
      </div>

      <a class="scroll-cue" href="#selected-works" aria-label="Scroll to selected works"><i></i></a>
    </div>
  </section>

  <div class="marquee" aria-label="Skills">
    <div class="marquee-track">
      @foreach ([false, true] as $isCopy)
        @foreach ($marqueeSkills as $skill)<span @if ($isCopy) aria-hidden="true" @endif>{{ $skill }}</span>@endforeach
      @endforeach
    </div>
  </div>

  <section class="home-profile-section" id="about-overview" aria-labelledby="profile-title">
    <div class="container profile-inner">
      <div class="profile-overview">
        <div class="profile-intro">
          <h2 id="profile-title">About Me</h2>
          <p>I'm a full-stack developer and UI/UX designer based in Davao City, Philippines. I create web solutions that are simple, functional, and built around real user needs.</p>
          <a class="profile-more" href="{{ route('about') }}">Get to Know Me <span aria-hidden="true">→</span></a>
        </div>

        <div class="profile-capabilities" aria-label="Core capabilities">
          @foreach ($capabilities as [$title, $text, $icon])
            <article class="profile-capability reveal">
              <svg viewBox="0 0 24 24" aria-hidden="true">{!! $icon !!}</svg>
              <h3>{{ $title }}</h3>
              <p>{{ $text }}</p>
            </article>
          @endforeach
        </div>
      </div>

      <div class="profile-skills" aria-labelledby="profile-skills-title">
        <div class="profile-skills-heading">
          <h2 id="profile-skills-title">Skills</h2>
          <p>Technologies and tools I use to bring ideas to life.</p>
        </div>
        <div class="technology-grid">
          @foreach ($technologies as [$label, $icon])
            <div class="technology-item reveal">
              <img
                src="{{ $icon === 'anthropic' ? 'https://cdn.simpleicons.org/anthropic' : "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/{$icon}/{$icon}-original.svg" }}"
                alt="{{ $icon === 'anthropic' ? 'Claude logo' : '' }}"
                loading="lazy" width="40" height="40">
              <span>{{ $label }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="home-section container" id="selected-works">
    <div class="section-heading">
      <h2>Sample Works</h2>
      <a class="btn btn-light" href="{{ route('works') }}">View all works <span aria-hidden="true">→</span></a>
    </div>
    <div class="home-work-grid" id="featured-grid">
      @forelse ($works as $work)
        <x-work-card :work="$work" home />
      @empty
        <p class="works-empty">Published projects will appear here.</p>
      @endforelse
    </div>
  </section>

  <section class="services-band">
    <div class="container">
      <div class="section-heading centered">
        <div>
          <p class="eyebrow">WHAT I DO</p>
          <h2>Design that works, code that lasts</h2>
        </div>
      </div>
      <div class="service-grid">
        @foreach ($services as $index => [$icon, $title, $text])
          <article class="service-card reveal">
            <span class="service-icon">{!! $icon !!}</span>
            <h3>{{ $title }}</h3>
            <p>{{ $text }}</p>
            <b>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</b>
          </article>
        @endforeach
      </div>
    </div>
  </section>
</main>
</x-layouts.portfolio>