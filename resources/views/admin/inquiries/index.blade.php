@extends('layouts.admin')

@section('header', 'Inquiries')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Contact Form Inquiries</h1>
</div>

<div class="overflow-x-auto bg-gray-900 rounded-lg border border-gray-800">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-800 bg-gray-800/50">
                <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Received</th>
                <th class="px-6 py-3 text-right text-sm font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inquiries as $inquiry)
            <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-semibold">{{ $inquiry->name }}</p>
                        <p class="text-sm text-gray-400">{{ $inquiry->email }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm">{{ $inquiry->email }}</td>
                <td class="px-6 py-4">
                    <span class="inline-block px-3 py-1 rounded-full text-sm
                        {{ $inquiry->status === 'responded' ? 'bg-green-900/30 text-green-400' : ($inquiry->status === 'read' ? 'bg-yellow-900/30 text-yellow-400' : 'bg-blue-900/30 text-blue-400') }}">
                        {{ ucfirst($inquiry->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-400">{{ $inquiry->created_at->format('M d, Y H:i') }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">View</a>
                        <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm transition">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="px-6 py-12 text-center text-gray-400">No inquiries yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $inquiries->links() }}
</div>
@endsection
