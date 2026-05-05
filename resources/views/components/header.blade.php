<header class="sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-950/80 backdrop-blur-xl">
    <nav class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-3xl font-black tracking-tight">
            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Portfolio</span>
        </a>

        <!-- Navigation Links -->
        <div class="hidden md:flex gap-12">
            <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold transition duration-300">Home</a>
            <a href="/about" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold transition duration-300">About</a>
            <a href="/portfolio" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold transition duration-300">Portfolio</a>
            <a href="/services" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold transition duration-300">Services</a>
            <a href="#contact" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold transition duration-300">Contact</a>
        </div>

        <!-- Mobile Menu & Admin Button -->
        <div class="flex items-center gap-4">
            <a href="/admin/projects" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 hidden sm:inline-block flex items-center gap-2">
                <i class="fas fa-lock"></i>
                Admin
            </a>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 dark:border-gray-800 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-4">
            <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold py-2">Home</a>
            <a href="/about" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold py-2">About</a>
            <a href="/portfolio" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold py-2">Portfolio</a>
            <a href="/services" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold py-2">Services</a>
            <a href="#contact" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold py-2">Contact</a>
            <a href="/admin/projects" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold text-center mt-2 flex items-center justify-center gap-2">
                <i class="fas fa-lock"></i>
                Admin Panel
            </a>
        </div>
    </div>
</header>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
</script>
