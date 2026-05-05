@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <!-- Header -->
    <a href="/portfolio" class="text-blue-600 hover:text-blue-700 font-semibold mb-6 inline-block">← Back to Portfolio</a>

    <div class="mb-12">
        <h1 class="text-5xl font-bold mb-4">{{ $project->title }}</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400">{{ $project->description }}</p>
    </div>

    <!-- Featured Image -->
    <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl h-96 mb-12 flex items-center justify-center">
        <div class="text-6xl">📸</div>
    </div>

    <!-- Content -->
    <div class="grid md:grid-cols-3 gap-12 mb-12">
        <div class="md:col-span-2">
            <h2 class="text-3xl font-bold mb-6">Project Overview</h2>
            @if($project->problem_solution)
            <div class="prose dark:prose-invert max-w-none mb-8">
                {!! nl2br(e($project->problem_solution)) !!}
            </div>
            @else
            <p class="text-gray-600 dark:text-gray-400 mb-8">{{ $project->description }}</p>
            @endif

            @if($project->role)
            <h3 class="text-2xl font-bold mb-4">My Role</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-8">{!! nl2br(e($project->role)) !!}</p>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6">
                @if($project->technologies)
                <h3 class="font-bold text-lg mb-4">Technologies</h3>
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($project->technologies as $tech)
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-full text-sm">{{ $tech }}</span>
                    @endforeach
                </div>
                @endif

                <div class="space-y-4">
                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" class="block w-full px-4 py-3 bg-blue-600 text-white text-center font-semibold rounded-lg hover:bg-blue-700 transition">
                        View Live Demo
                    </a>
                    @endif

                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-700 text-center font-semibold rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        View Code on GitHub
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <section class="bg-blue-600 text-white rounded-2xl p-12 text-center">
        <h2 class="text-3xl font-bold mb-4">Like what you see?</h2>
        <p class="text-lg mb-8">Let's discuss how I can help with your next project</p>
        <a href="/contact" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
            Get In Touch
        </a>
    </section>
</div>
@endsection
