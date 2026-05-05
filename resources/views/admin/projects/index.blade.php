@extends('layouts.admin')

@section('header', 'Projects Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
        + Add Project
    </a>
</div>

<div class="overflow-x-auto bg-gray-900 rounded-lg border border-gray-800">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-800 bg-gray-800/50">
                <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Featured</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Created</th>
                <th class="px-6 py-3 text-right text-sm font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-semibold">{{ $project->title }}</p>
                        <p class="text-sm text-gray-400">{{ $project->slug }}</p>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-block px-3 py-1 rounded-full text-sm {{ $project->is_active ? 'bg-green-900/30 text-green-400' : 'bg-gray-700 text-gray-400' }}">
                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span class="text-sm">{{ $project->is_featured ? '⭐ Yes' : '✗ No' }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-400">
                    {{ $project->created_at->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">Edit</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm transition">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="px-6 py-12 text-center text-gray-400 col-span-5">No projects yet. Create one to get started!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $projects->links() }}
</div>
@endsection
