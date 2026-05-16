@props(['service', 'index' => null])

<div class="sv-service-card">

    {{-- Gold top stripe --}}
    <div class="sv-card-stripe"></div>

    {{-- Header: icon + service name --}}
    <div class="sv-card-header">
        <div class="sv-service-card-icon" aria-hidden="true">
            {{ $service->icon ?? '🚀' }}
        </div>
        <div class="sv-card-header-text">
            <span class="sv-field-label">Service</span>
            <h3 class="sv-service-card-title">{{ $service->title }}</h3>
        </div>
    </div>

    {{-- Description --}}
    <div class="sv-card-field">
        <span class="sv-field-label">Description</span>
        <p class="sv-service-card-description">{{ $service->description }}</p>
    </div>

    {{-- Deliverables --}}
    @if($service->deliverables)
    <div class="sv-card-field">
        <span class="sv-field-label">Deliverables</span>
        <ul class="sv-service-card-list">
            @foreach($service->deliverables as $item)
            <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Tools --}}
    @if($service->tools)
    <div class="sv-card-field">
        <span class="sv-field-label">Tools</span>
        <div class="sv-service-card-tags">
            @foreach($service->tools as $tool)
            <span class="sv-service-card-tag">{{ $tool }}</span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Footer: price range + CTA --}}
    <div class="sv-service-card-footer">

        @if($service->price_range)
        <div class="sv-service-card-price-row">
            <span class="sv-field-label" style="margin-bottom:0;">Price Range</span>
            <span class="sv-service-card-price">{{ $service->price_range }}</span>
        </div>
        @endif

        <a href="/contact" class="sv-service-card-button">
            Discuss this service
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
            </svg>
        </a>

    </div>
</div>