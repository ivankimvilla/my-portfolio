@props([
    'active' => ''
])
<nav class="site-nav" aria-label="Main navigation">
  <div class="nav-inner">
    <a class="logo" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home">
      <span>IK</span>
    </a>
    <div class="nav-links" id="site-links">
      <a class="{{ $active === 'home' ? 'on' : '' }}" href="{{ route('home') }}" @if ($active === 'home') aria-current="page" @endif>Home</a>
      <a class="{{ $active === 'about' ? 'on' : '' }}" href="{{ route('about') }}" @if ($active === 'about') aria-current="page" @endif>About Me</a>
      <a class="{{ $active === 'works' ? 'on' : '' }}" href="{{ route('works') }}" @if ($active === 'works') aria-current="page" @endif>Works</a>
    </div>
    <button class="nav-toggle" type="button" aria-controls="site-links" aria-expanded="false" aria-label="Open navigation">☰</button>
  </div>
</nav>
