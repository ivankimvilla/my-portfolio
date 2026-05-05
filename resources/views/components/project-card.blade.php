@props(['project'])

<a href="{{ route('portfolio.show', $project) }}" class="group relative overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-blue-500 dark:hover:border-blue-400 bg-white dark:bg-gray-950 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 via-purple-600/10 to-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Image Section -->
    <div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 h-48 flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white rounded-full mix-blend-multiply filter blur-2xl"></div>
        </div>
        <div class="relative text-6xl group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">📦</div>
    </div>

    <!-- Content Section -->
    <div class="relative p-8 space-y-4">
        <div>
            <h3 class="text-2xl font-black mb-3 text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                {{ $project->title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed line-clamp-3">
                {{ $project->description }}
            </p>
        </div>

        <!-- Technologies -->
        @if($project->technologies)
        <div class="pt-2">
            <div class="flex gap-2 flex-wrap">
                @foreach($project->technologies as $tech)
                <span class="px-3 py-1.5 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 rounded-full text-xs font-semibold border border-blue-200 dark:border-blue-800">
                    {{ $tech }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Learn More Arrow -->
        <div class="pt-2 flex items-center gap-2 text-blue-600 dark:text-blue-400 font-semibold text-sm group-hover:gap-3 transition-all duration-300">
            <span>View Project</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </div>
    </div>
</a>
