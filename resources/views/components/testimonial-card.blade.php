@props(['testimonial'])

<div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-8 border border-gray-200 dark:border-gray-800">
    <!-- Stars -->
    <div class="mb-4">
        @for($i = 0; $i < $testimonial->rating; $i++)
        <span class="text-yellow-400">★</span>
        @endfor
    </div>

    <!-- Quote -->
    <p class="text-gray-700 dark:text-gray-300 mb-6 italic">"{{ $testimonial->content }}"</p>

    <!-- Author -->
    <div class="flex items-center gap-3">
        @if($testimonial->client_image)
        <img src="{{ $testimonial->client_image }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-full object-cover">
        @else
        <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
            {{ substr($testimonial->client_name, 0, 1) }}
        </div>
        @endif

        <div>
            <p class="font-bold">{{ $testimonial->client_name }}</p>
            @if($testimonial->client_company || $testimonial->client_title)
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $testimonial->client_title }}{{ $testimonial->client_title && $testimonial->client_company ? ' at ' : '' }}{{ $testimonial->client_company }}
            </p>
            @endif
        </div>
    </div>
</div>
