@props(['showHeading' => true])

<div class="space-y-6">
    @if($showHeading)
    <h2 class="text-3xl font-black text-gray-900 dark:text-white">Send Me a Message</h2>
    @endif

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-xl border border-green-200 dark:border-green-800 font-medium">
        ✓ {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6" id="contactForm">
        @csrf

        <!-- Name Field -->
        <div>
            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3">Your Name <span class="text-red-600">*</span></label>
            <input type="text" name="name" required class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-600/20 transition @error('name') border-red-600 @enderror"
                   value="{{ old('name') }}" placeholder="John Doe">
            @error('name')
            <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3">Your Email <span class="text-red-600">*</span></label>
            <input type="email" name="email" required class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-600/20 transition @error('email') border-red-600 @enderror"
                   value="{{ old('email') }}" placeholder="john@example.com">
            @error('email')
            <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Field -->
        <div>
            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3">Phone <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span></label>
            <input type="tel" name="phone" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-600/20 transition"
                   value="{{ old('phone') }}" placeholder="+1 (555) 123-4567">
            @error('phone')
            <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Subject Field -->
        <div>
            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3">Subject <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span></label>
            <input type="text" name="subject" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-600/20 transition"
                   value="{{ old('subject') }}" placeholder="What is this about?">
            @error('subject')
            <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Message Field -->
        <div>
            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3">Message <span class="text-red-600">*</span></label>
            <textarea name="message" rows="5" required class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-600/20 transition resize-none @error('message') border-red-600 @enderror"
                      placeholder="Tell me about your project...">{{ old('message') }}</textarea>
            @error('message')
            <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 active:scale-95">
            Send Message
        </button>

        <p class="text-xs text-gray-600 dark:text-gray-400 text-center">
            I'll respond to your message within 24 hours
        </p>
    </form>
</div>
