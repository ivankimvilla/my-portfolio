@extends('layouts.admin')

@section('header', 'Edit Project')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.projects.index') }}" class="text-blue-400 hover:text-blue-300 mb-6 inline-block">← Back</a>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="bg-gray-900 p-8 rounded-lg border border-gray-800 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-sm font-semibold mb-2">Project Title *</label>
            <input type="text" name="title" required class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('title') ring-red-600 @enderror" value="{{ old('title', $project->title) }}">
            @error('title')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Slug *</label>
            <input type="text" name="slug" required class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('slug') ring-red-600 @enderror" value="{{ old('slug', $project->slug) }}">
            @error('slug')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('description') ring-red-600 @enderror">{{ old('description', $project->description) }}</textarea>
            @error('description')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Problem & Solution</label>
            <textarea name="problem_solution" rows="6" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('problem_solution', $project->problem_solution) }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Detailed explanation of the problem and your solution</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold mb-2">Image URL</label>
                <input type="url" name="image_url" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('image_url', $project->image_url) }}">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Display Order</label>
                <input type="number" name="display_order" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('display_order', $project->display_order) }}">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold mb-2">Live URL</label>
                <input type="url" name="live_url" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('live_url', $project->live_url) }}">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">GitHub URL</label>
                <input type="url" name="github_url" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('github_url', $project->github_url) }}">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Technologies (comma-separated)</label>
            <input type="text" name="technologies" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}">
            <p class="text-xs text-gray-400 mt-1">e.g., Laravel, React, MySQL</p>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Your Role</label>
            <textarea name="role" rows="3" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('role', $project->role) }}</textarea>
            <p class="text-xs text-gray-400 mt-1">What did you do on this project?</p>
        </div>

        <div class="flex gap-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 rounded" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                <span>Featured Project</span>
            </label>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                <span>Active</span>
            </label>
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-800">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                Update Project
            </button>
            <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 border border-gray-700 rounded-lg hover:bg-gray-800 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
