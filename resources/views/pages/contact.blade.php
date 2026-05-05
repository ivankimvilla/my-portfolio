@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <h1 class="text-5xl font-bold mb-6 text-center">Get In Touch</h1>
    <p class="text-xl text-gray-600 dark:text-gray-400 mb-16 text-center max-w-2xl mx-auto">Let's work together to bring your project to life. Send me a message and I'll get back to you as soon as possible.</p>

    <div class="grid md:grid-cols-2 gap-12 max-w-5xl mx-auto">
        <!-- Contact Form -->
        <x-contact-form :showHeading="true" />

        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-bold mb-8">Contact Information</h2>

            <div class="space-y-8">
                <!-- Email -->
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl">📧</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Email</h3>
                        <p class="text-gray-600 dark:text-gray-400">hello@example.com</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">I typically respond within 24 hours</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl">📞</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Phone</h3>
                        <p class="text-gray-600 dark:text-gray-400">+1 (555) 123-4567</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Mon-Fri, 9 AM - 6 PM EST</p>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl">📍</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Location</h3>
                        <p class="text-gray-600 dark:text-gray-400">Davao City, Philippines</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Available for remote work worldwide</p>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl">🔗</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-3">Social Links</h3>
                        <div class="flex gap-4">
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">GitHub</a>
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">LinkedIn</a>
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Twitter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800">
                <h3 class="font-bold text-lg mb-4">Quick FAQs</h3>
                <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">How long does a typical project take?</p>
                        <p>Depends on scope. Small projects: 2-4 weeks. Medium: 1-3 months. Large: custom timeline.</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">What's your hourly rate?</p>
                        <p>$75-150/hour depending on complexity. I also offer fixed-price project contracts.</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">Do you provide maintenance support?</p>
                        <p>Yes, I offer ongoing maintenance and support packages for deployed projects.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
