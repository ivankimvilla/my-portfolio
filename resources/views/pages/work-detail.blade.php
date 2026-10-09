<x-layouts.portfolio title="{{ $work->title }} — Ivan Kim Almadin" page-css="css/pages/works.css" page-js="js/pages/works.js" active="works" body-class="portfolio-works">
  <main class="container work-detail-page">
    <a class="work-detail-back" href="{{ route('works') }}">← All works</a>
    <article>
      <div class="work-detail-image"><img src="{{ route('works.image', $work) }}" alt="{{ $work->title }}"></div>
      <div class="work-detail-content">
        @if ($work->category)<p class="work-detail-category">{{ $work->category }}</p>@endif
        <h1>{{ $work->title }}</h1>
        <p class="work-detail-summary">{{ $work->short_description }}</p>
        @if (trim($work->full_description) !== trim($work->short_description))
          <div class="work-detail-description">{!! nl2br(e($work->full_description)) !!}</div>
        @endif
        @if ($work->tools)
          <div class="tag-list" aria-label="Tools used"><strong class="tag-label">Tech:</strong>@foreach ($work->tools as $tool)<span>{{ $tool }}</span>@endforeach</div>
        @endif
        @if ($work->project_url)
          <a class="project-link" href="{{ $work->project_url }}" target="_blank" rel="noopener noreferrer">Visit project <span aria-hidden="true">↗</span></a>
        @endif
      </div>
    </article>
    @if ($work->galleryImages->isNotEmpty())
      <div class="work-detail-gallery" aria-label="More project images">
        @foreach ($work->galleryImages as $index => $galleryImage)
          <figure><img src="{{ route('works.gallery-image', [$work, $galleryImage]) }}" alt="{{ $work->title }} image {{ $index + 2 }}" width="1200" height="900" loading="lazy"></figure>
        @endforeach
      </div>
    @endif
  </main>
</x-layouts.portfolio>