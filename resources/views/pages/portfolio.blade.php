@extends('layouts.app')

@section('title', 'Portfolio - My Projects')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <h1 class="text-5xl font-bold mb-6">My Portfolio</h1>
    <p class="text-xl text-gray-600 dark:text-gray-400 mb-12">A collection of projects I've built. Each showcasing problem-solving and technical expertise.</p>

    <!-- Filters -->
    <div class="mb-12 flex gap-3 flex-wrap">
        <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">All</button>
        <button class="px-6 py-2 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">Laravel</button>
        <button class="px-6 py-2 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">React</button>
        <button class="px-6 py-2 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">PHP</button>
    </div>

    <!-- Projects Grid -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        @forelse($projects as $project)
        <x-project-card :project="$project" />
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-600 dark:text-gray-400 text-lg">No projects yet. Check back soon!</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $projects->links() }}
    </div>
</div>
@endsection
