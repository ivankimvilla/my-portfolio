@extends('layouts.admin')

@section('header', 'Services Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Services</h1>
    <a href="{{ route('admin.services.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
        + Add Service
    </a>
</div>

<div class="overflow-x-auto bg-gray-900 rounded-lg border border-gray-800">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-800 bg-gray-800/50">
                <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Certificate</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Price Range</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Created</th>
                <th class="px-6 py-3 text-right text-sm font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-semibold">{{ $service->title }}</p>
                        <p class="text-sm text-gray-400">{{ $service->slug }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm">
                    @if($service->certificate_path)
                        <a href="{{ asset('storage/' . $service->certificate_path) }}" target="_blank" class="text-blue-400 hover:underline">View</a>
                    @else
                        <span class="text-gray-400">None</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <span class="inline-block px-3 py-1 rounded-full text-sm {{ $service->is_active ? 'bg-green-900/30 text-green-400' : 'bg-gray-700 text-gray-400' }}">
                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">{{ $service->price_range ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-sm text-gray-400">{{ $service->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('admin.services.edit', $service) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm transition">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="px-6 py-12 text-center text-gray-400">No services yet. Create one!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $services->links() }}
</div>
@endsection
