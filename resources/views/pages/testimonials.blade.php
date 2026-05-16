@extends('layouts.app')

@section('title', 'Testimonials')

@section('content')


<link rel="stylesheet" href="{{ asset('css/pages/testimonials.css') }}">

<section class="testimonials-page">
    <div class="testimonials-inner">
        <div class="pf-eyebrow">Client Feedback</div>
        <h1 class="pf-section-title">All <em>Testimonials.</em></h1>
        <p class="pf-section-desc">Browse every approved client testimonial and discover feedback from recent projects.</p>

        <div class="pf-divider">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="pf-testimonials-grid">
            @forelse($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" />
            @empty
                <div class="pf-projects-empty" style="grid-column: 1 / -1;">
                    <i class="fas fa-comments"></i>
                    <p>No testimonials are available yet. Please check back soon.</p>
                </div>
            @endforelse
        </div>

        <div class="page-actions">
            <a href="{{ route('home') }}#testimonials" class="pf-btn-primary">Back to homepage</a>
        </div>
    </div>
</section>
@endsection
