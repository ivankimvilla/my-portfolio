@extends('layouts.admin')

@section('header', 'View Inquiry')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.inquiries.index') }}" class="text-blue-400 hover:text-blue-300 mb-6 inline-block">← Back to Inquiries</a>

    <div class="bg-gray-900 p-8 rounded-lg border border-gray-800">
        <!-- Header -->
        <div class="border-b border-gray-800 pb-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $inquiry->name }}</h1>
                    <p class="text-gray-400">Received on {{ $inquiry->created_at->format('M d, Y \a\t H:i') }}</p>
                </div>
                <span class="inline-block px-3 py-1 rounded-full text-sm
                    {{ $inquiry->status === 'responded' ? 'bg-green-900/30 text-green-400' : ($inquiry->status === 'read' ? 'bg-yellow-900/30 text-yellow-400' : 'bg-blue-900/30 text-blue-400') }}">
                    {{ ucfirst($inquiry->status) }}
                </span>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="text-sm font-semibold text-gray-400 mb-2">EMAIL</h3>
                <p class="text-lg"><a href="mailto:{{ $inquiry->email }}" class="text-blue-400 hover:text-blue-300">{{ $inquiry->email }}</a></p>
            </div>
            @if($inquiry->phone)
            <div>
                <h3 class="text-sm font-semibold text-gray-400 mb-2">PHONE</h3>
                <p class="text-lg"><a href="tel:{{ $inquiry->phone }}" class="text-blue-400 hover:text-blue-300">{{ $inquiry->phone }}</a></p>
            </div>
            @endif
        </div>

        <!-- Subject -->
        @if($inquiry->subject)
        <div class="mb-8">
            <h3 class="text-sm font-semibold text-gray-400 mb-2">SUBJECT</h3>
            <p class="text-lg">{{ $inquiry->subject }}</p>
        </div>
        @endif

        <!-- Message -->
        <div class="mb-8">
            <h3 class="text-sm font-semibold text-gray-400 mb-4">MESSAGE</h3>
            <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                <p class="text-gray-200 whitespace-pre-wrap leading-relaxed">{{ $inquiry->message }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="border-t border-gray-800 pt-6 flex gap-4">
            @if($inquiry->status !== 'responded')
            <form method="POST" action="{{ route('admin.inquiries.mark-responded', $inquiry) }}" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 rounded-lg font-semibold transition">
                    ✓ Mark as Responded
                </button>
            </form>
            @endif

            <a href="mailto:{{ $inquiry->email }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                📧 Reply via Email
            </a>

            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" style="display:inline;" onsubmit="return confirm('Delete this inquiry?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 rounded-lg font-semibold transition">
                    🗑 Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
