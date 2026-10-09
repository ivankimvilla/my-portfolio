@props(['work', 'home' => false])

@if ($home)
  <a class="work-card reveal" href="{{ route('works.show', $work) }}">
    <div class="project-thumb"><img class="project-photo" src="{{ route('works.image', $work) }}" alt="{{ $work->title }}" loading="lazy"></div>
    @if ($work->category)<small class="work-category">{{ $work->category }}</small>@endif
    <h3>{{ $work->title }}<span class="work-arrow" aria-hidden="true">→</span></h3>
    <p>{{ $work->short_description }}</p>
    @if ($work->tools)
      <p class="work-tools"><strong>Tech:</strong><span class="work-tool-list">@foreach ($work->tools as $tool)<span class="work-tool">{{ $tool }}</span>@endforeach</span></p>
    @endif
  </a>
@else
  <a class="work-card reveal" href="{{ route('works.show', $work) }}">
    <div class="project-thumb"><img class="project-photo" src="{{ route('works.image', $work) }}" alt="{{ $work->title }}" loading="lazy"></div>
    <div class="work-card-copy">
      @if ($work->category)<small class="work-category">{{ $work->category }}</small>@endif
      <h3>{{ $work->title }}</h3>
      <p class="work-description">{{ $work->short_description }}</p>
      @if ($work->tools)
        <p class="work-tools"><strong>Tech:</strong><span class="work-tool-list">@foreach ($work->tools as $tool)<span class="work-tool">{{ $tool }}</span>@endforeach</span></p>
      @endif
    </div>
  </a>
@endif