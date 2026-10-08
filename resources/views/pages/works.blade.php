<x-layouts.portfolio title="Works — Ivan Kim Almadin" page-css="css/pages/works.css" page-js="js/pages/works.js" active="works" body-class="portfolio-works">
<main id="works">
  <section class="works-hero">
    <div class="works-hero-image" aria-hidden="true"></div>
    <div class="container works-hero-content">
      <div class="works-heading">
        <p class="eyebrow" style="--i:0">My Works</p>
        <h1 style="--i:1">Projects that reflect<br>my skills and creativity.</h1>
        <p class="works-intro" style="--i:2">Here are some of the web applications and UI/UX designs I've worked on. Each project represents my passion for building useful and beautiful digital experiences.</p>
      </div>
      <div class="filter-pills" style="--i:3" role="group" aria-label="Filter projects by category">
        <a class="filter-pill {{ $category === null ? 'active' : '' }}" href="{{ route('works') }}" @if ($category === null) aria-current="page" @endif>All</a>
        @foreach ($categories as $workCategory)
          <a class="filter-pill {{ $category === $workCategory ? 'active' : '' }}" href="{{ route('works', ['category' => $workCategory]) }}" @if ($category === $workCategory) aria-current="page" @endif>{{ $workCategory }}</a>
        @endforeach
      </div>
    </div>
  </section>
  <section class="container works-list" id="works-grid" aria-live="polite">
    <div class="work-group">
      <header class="work-group-heading">
        <h2>{{ $category ?? 'Published works' }}</h2>
        <p>{{ $works->total() }} {{ Str::plural('project', $works->total()) }}</p>
      </header>
      <div class="works-cards">
        @forelse ($works as $work)
          <x-work-card :work="$work" />
        @empty
          <p class="works-empty">No published projects in this category yet.</p>
        @endforelse
      </div>
      {{ $works->links('components.pagination') }}
    </div>
  </section>
</main>
</x-layouts.portfolio>