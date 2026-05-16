@props(['testimonial'])

<article class="pf-testimonial-card">

    {{-- Stars --}}
    <div class="pf-testimonial-rating">
        @for($i = 0; $i < $testimonial->rating; $i++)
            <span style="color:#FACC15; font-size:15px;">★</span>
        @endfor
        @for($i = $testimonial->rating; $i < 5; $i++)
            <span style="color:rgba(255,255,255,.15); font-size:15px;">★</span>
        @endfor
    </div>

    {{-- Quote --}}
    <p class="pf-testimonial-quote" style="word-break: break-word; overflow-wrap: anywhere; white-space: pre-wrap;">"{{ $testimonial->content }}"</p>

    {{-- Author --}}
    <div class="pf-testimonial-author">
        @if($testimonial->client_image)
            <img src="{{ $testimonial->client_image }}"
                 alt="{{ $testimonial->client_name }}"
                 class="pf-testimonial-avatar object-cover">
        @else
            <div class="pf-testimonial-avatar">
                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
            </div>
        @endif

        <div class="pf-testimonial-author-info">
            <div class="pf-testimonial-author-name">{{ $testimonial->client_name }}</div>

            @if($testimonial->client_company || $testimonial->client_title)
                <div class="pf-testimonial-author-meta">
                    {{ $testimonial->client_title }}{{ $testimonial->client_title && $testimonial->client_company ? ' at ' : '' }}{{ $testimonial->client_company }}
                </div>
            @endif

            @if($testimonial->project_url)
                <a href="{{ $testimonial->project_url }}"
                   class="pf-testimonial-link"
                   target="_blank"
                   rel="noopener">
                    View client project <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                </a>
            @endif
        </div>
    </div>

</article>