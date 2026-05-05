@props(['service'])

<div class="border border-gray-200 dark:border-gray-800 rounded-xl p-8 hover:shadow-lg dark:hover:shadow-gray-800 transition">
    <div class="text-5xl mb-4">{{ $service->icon ?? '🚀' }}</div>
    <h3 class="text-2xl font-bold mb-4">{{ $service->title }}</h3>
    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ $service->description }}</p>

    @if($service->deliverables)
    <h4 class="font-bold mb-3">Deliverables:</h4>
    <ul class="space-y-2 mb-6 text-sm text-gray-600 dark:text-gray-400">
        @foreach($service->deliverables as $item)
        <li>✓ {{ $item }}</li>
        @endforeach
    </ul>
    @endif

    @if($service->tools)
    <h4 class="font-bold mb-3">Tools & Tech:</h4>
    <div class="flex gap-2 flex-wrap mb-6">
        @foreach($service->tools as $tool)
        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-full text-sm">{{ $tool }}</span>
        @endforeach
    </div>
    @endif

    @if($service->price_range)
    <p class="text-blue-600 font-bold text-lg">{{ $service->price_range }}</p>
    @endif

    <a href="/contact" class="mt-6 inline-block text-blue-600 hover:text-blue-700 font-semibold">
        Discuss This Service →
    </a>
</div>
