@extends('layouts.app')

@section('title', 'Services - Ivan Kim Almadin')

@section('content')


<link rel="stylesheet" href="{{ asset('css/pages/services.css') }}">

<div class="sv-page">
<div class="sv-container">

    {{-- ══ HERO HEADER ══ --}}
    <section class="sv-hero">
        <div class="sv-hero-rule sv-hero-rule-top"></div>
        <div class="sv-hero-rule sv-hero-rule-bottom"></div>

        <div class="sv-hero-inner">
            <div class="sv-hero-tag">
                <i class="fas fa-concierge-bell" style="font-size:9px;"></i>
                What I Offer
            </div>

            <h1 class="sv-hero-title">My <em>Services.</em></h1>

            <p class="sv-hero-desc">
                Comprehensive web development and consulting services tailored to help your
                business grow and succeed in the digital landscape.
            </p>
        </div>
    </section>

    {{-- ══ SERVICES GRID ══ --}}
    <section class="sv-section">
        <div class="sv-eyebrow">Capabilities</div>
        <h2 class="sv-section-title">What I <em>Do.</em></h2>

        <div class="sv-divider">
            <div class="sv-divider-line"></div>
            <div class="sv-divider-dot"></div>
            <div class="sv-divider-line"></div>
        </div>

        <div class="sv-grid">
            @forelse($services as $index => $service)
                <x-service-card :service="$service" :index="$loop->iteration" />
            @empty
                <div class="sv-empty">
                    <div class="sv-empty-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <p>No services configured yet.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="sv-cta">
        <div class="sv-cta-inner">
            <div class="sv-eyebrow" style="justify-content:center;">Custom Solutions</div>
            <h2 class="sv-cta-title">Can't find what you're <em>looking for?</em></h2>
            <p class="sv-cta-desc">
                I also offer custom solutions tailored to your specific needs. Let's talk and figure out exactly what works for you.
            </p>
            <a href="/contact" class="sv-btn-primary" style="display:inline-flex; position:relative; z-index:1;">
                <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>Let's Discuss</span>
            </a>
        </div>
    </section>

</div>
</div>

@endsection