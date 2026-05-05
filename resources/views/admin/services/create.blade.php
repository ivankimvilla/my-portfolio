@extends('layouts.admin')

@section('header', 'Create Service')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.services.index') }}" class="text-blue-400 hover:text-blue-300 mb-6 inline-block">← Back</a>

    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="bg-gray-900 p-8 rounded-lg border border-gray-800 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold mb-2">Service Title *</label>
            <input type="text" name="title" required class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('title') ring-red-600 @enderror" value="{{ old('title') }}" placeholder="Web Development">
            @error('title')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Slug *</label>
            <input type="text" name="slug" required class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('slug') ring-red-600 @enderror" value="{{ old('slug') }}" placeholder="web-development">
            @error('slug')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('description') ring-red-600 @enderror">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold mb-2">Icon (emoji)</label>
                <input type="text" name="icon" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('icon') }}" placeholder="🚀" maxlength="2">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Price Range</label>
                <input type="text" name="price_range" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('price_range') }}" placeholder="$5,000 - $15,000">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Deliverables (one per line)</label>
            <textarea name="deliverables" rows="4" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('deliverables') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">e.g., Design mockups\nFrontend development\nBackend API</p>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Tools & Technologies (comma-separated)</label>
            <input type="text" name="tools" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('tools') }}" placeholder="Laravel, React, PostgreSQL">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Certificate (PDF or image)</label>
            <input type="file" name="certificate" accept="application/pdf,image/jpeg,image/png" class="w-full text-sm text-gray-100 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            @error('certificate')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1">Upload a certificate file for this service (max 5MB).</p>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Display Order</label>
            <input type="number" name="display_order" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('display_order', 0) }}">
        </div>

        <div class="flex gap-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded" {{ old('is_active', true) ? 'checked' : '' }}>
                <span>Active</span>
            </label>
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-800">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                Create Service
            </button>
            <a href="{{ route('admin.services.index') }}" class="px-6 py-2 border border-gray-700 rounded-lg hover:bg-gray-800 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
