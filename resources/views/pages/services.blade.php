@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <h1 class="text-5xl font-bold mb-6 text-center">Services</h1>
    <p class="text-xl text-gray-600 dark:text-gray-400 mb-16 text-center max-w-3xl mx-auto">I offer comprehensive web development and consulting services tailored to help your business grow and succeed in the digital landscape.</p>

    <!-- Services Grid -->
    <div class="grid md:grid-cols-2 gap-8 mb-16">
        @forelse($services as $service)
        <x-service-card :service="$service" />
        @empty
        <div class="col-span-2 text-center py-12">
            <p class="text-gray-600 dark:text-gray-400 text-lg">No services configured yet.</p>
        </div>
        @endforelse
    </div>

    <!-- CTA -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-center text-white">
        <h2 class="text-4xl font-bold mb-4">Can't find what you're looking for?</h2>
        <p class="text-xl mb-8 opacity-90">I also offer custom solutions tailored to your specific needs</p>
        <a href="/contact" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
            Let's Discuss
        </a>
    </section>
</div>
@endsection
