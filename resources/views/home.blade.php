@extends('layouts.app')

@section('title', 'Home - Full Stack Developer')

@section('content')
<div class="min-h-screen flex flex-col">
    <div class="max-w-7xl mx-auto px-6 py-20 w-full">
        <!-- Hero Section -->
        <section class="mb-40">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8 animate-fade-in">
                    <div>
                        <h1 class="text-6xl md:text-7xl font-black mb-8 leading-tight tracking-tight text-gray-900 dark:text-white">
                            Hi, I'm <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-clip-text text-transparent">Ivan Kim Almadin</span>
                        </h1>
                        <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-2 font-medium">Full-Stack Developer & Digital Architect</p>
                    </div>
                    <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed max-w-lg">
                        I craft elegant, scalable solutions for complex problems. Specializing in modern web applications, cloud architectures, and impactful digital experiences.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#contact" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-300 transform hover:scale-105 inline-block">
                            Start a Project
                        </a>
                        <a href="/portfolio" class="px-8 py-4 border-2 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white font-semibold rounded-xl hover:border-blue-600 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all duration-300 inline-block">
                            View My Work
                        </a>
                    </div>
                </div>

                <!-- Hero Image Card -->
                <div class="relative h-96 md:h-full min-h-96 animate-float">
                    <!-- Glow Effect Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-purple-600/20 rounded-3xl blur-3xl"></div>

                    <!-- Professional Photo Card -->
                    <div class="relative rounded-3xl h-full overflow-hidden shadow-2xl border-2 border-gray-200 dark:border-gray-700 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center">
                        <!-- Placeholder for Photo - Replace with your image -->
                        <img
                            src="https://via.placeholder.com/600x600/2563eb/ffffff?text=Your+Photo"
                            alt="Ivan Kim Almadin"
                            class="w-full h-full object-cover"
                        >

                        <!-- Overlay gradient (optional, for better text readability if needed) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Info Card (visible on hover) -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 transform translate-y-full hover:translate-y-0 transition-transform duration-300">
                            <p class="text-white font-semibold text-lg">Full-Stack Developer</p>
                            <p class="text-gray-200 text-sm">Available for Projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Featured Projects -->
    <section class="mb-40">
        <div class="space-y-12">
            <div class="space-y-4 animate-fade-in">
                <h2 class="text-5xl md:text-6xl font-black tracking-tight text-gray-900 dark:text-white">Featured Projects</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl">A selection of my recent work showcasing modern web development practices</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse($featuredProjects as $project)
                <x-project-card :project="$project" />
                @empty
                <div class="col-span-3 text-center py-24">
                    <div class="space-y-4">
                        <div class="text-6xl"><i class="fas fa-rocket text-blue-600"></i></div>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Featured projects coming soon!</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Technical Skills -->
    <section class="mb-40">
        <div class="space-y-12">
            <div class="space-y-4">
                <h2 class="text-5xl md:text-6xl font-black tracking-tight text-gray-900 dark:text-white">Technical Expertise</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl">A comprehensive toolkit of technologies and skills</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <!-- Backend -->
                <div class="group p-8 bg-gradient-to-br from-blue-50 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-900/5 rounded-2xl border border-blue-200 dark:border-blue-800 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center mb-4 text-white text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="font-black text-xl mb-4 text-gray-900 dark:text-white">Backend</h3>
                    <ul class="text-gray-700 dark:text-gray-300 space-y-2 text-sm font-medium">
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>PHP/Laravel</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>Node.js</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>REST APIs</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>Database Design</li>
                    </ul>
                </div>

                <!-- Frontend -->
                <div class="group p-8 bg-gradient-to-br from-purple-50 to-purple-100/50 dark:from-purple-900/20 dark:to-purple-900/5 rounded-2xl border border-purple-200 dark:border-purple-800 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl flex items-center justify-center mb-4 text-white text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 class="font-black text-xl mb-4 text-gray-900 dark:text-white">Frontend</h3>
                    <ul class="text-gray-700 dark:text-gray-300 space-y-2 text-sm font-medium">
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-600 rounded-full mr-3"></span>React/Vue</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-600 rounded-full mr-3"></span>Tailwind CSS</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-600 rounded-full mr-3"></span>JavaScript/TypeScript</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-600 rounded-full mr-3"></span>Responsive Design</li>
                    </ul>
                </div>

                <!-- Database -->
                <div class="group p-8 bg-gradient-to-br from-pink-50 to-pink-100/50 dark:from-pink-900/20 dark:to-pink-900/5 rounded-2xl border border-pink-200 dark:border-pink-800 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-600 to-pink-700 rounded-xl flex items-center justify-center mb-4 text-white text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="font-black text-xl mb-4 text-gray-900 dark:text-white">Database</h3>
                    <ul class="text-gray-700 dark:text-gray-300 space-y-2 text-sm font-medium">
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-600 rounded-full mr-3"></span>MySQL</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-600 rounded-full mr-3"></span>PostgreSQL</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-600 rounded-full mr-3"></span>MongoDB</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-600 rounded-full mr-3"></span>Query Optimization</li>
                    </ul>
                </div>

                <!-- Tools -->
                <div class="group p-8 bg-gradient-to-br from-green-50 to-green-100/50 dark:from-green-900/20 dark:to-green-900/5 rounded-2xl border border-green-200 dark:border-green-800 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-600 to-green-700 rounded-xl flex items-center justify-center mb-4 text-white text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="font-black text-xl mb-4 text-gray-900 dark:text-white">Tools & DevOps</h3>
                    <ul class="text-gray-700 dark:text-gray-300 space-y-2 text-sm font-medium">
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-600 rounded-full mr-3"></span>Git/GitHub</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-600 rounded-full mr-3"></span>Docker</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-600 rounded-full mr-3"></span>AWS/Azure</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-600 rounded-full mr-3"></span>CI/CD Pipelines</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="mb-40">
        <div class="relative overflow-hidden rounded-3xl p-12 md:p-20">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl"></div>
            </div>
            <div class="relative z-10 text-center text-white">
                <h2 class="text-5xl md:text-6xl font-black mb-6 tracking-tight">Ready to collaborate?</h2>
                <p class="text-xl md:text-2xl mb-10 opacity-95 max-w-2xl mx-auto">Let's discuss your project and create something extraordinary together</p>
                <a href="#contact" class="inline-block px-8 py-4 bg-white text-blue-600 font-bold rounded-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    Start Conversation
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="mb-20">
        <div class="space-y-12">
            <div class="space-y-4">
                <h2 class="text-5xl md:text-6xl font-black tracking-tight text-gray-900 dark:text-white">Let's Connect</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Reach out to discuss your project or collaborations</p>
            </div>

            <div class="grid md:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div>
                    <x-contact-form :showHeading="false" />
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <h3 class="text-3xl font-black mb-8">Get In Touch</h3>

                    <!-- Email -->
                    <div class="group p-6 rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-lg transition-all duration-300">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center flex-shrink-0 text-white text-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1 text-gray-900 dark:text-white">Email</h4>
                                <p class="text-gray-600 dark:text-gray-400">hello@example.com</p>
                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">I'll respond within 24 hours</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="group p-6 rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-purple-500 dark:hover:border-purple-400 hover:shadow-lg transition-all duration-300">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl flex items-center justify-center flex-shrink-0 text-white text-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1 text-gray-900 dark:text-white">Phone</h4>
                                <p class="text-gray-600 dark:text-gray-400">+1 (555) 123-4567</p>
                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">Available Mon-Fri, 9am-6pm EST</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="group p-6 rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-pink-500 dark:hover:border-pink-400 hover:shadow-lg transition-all duration-300">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-pink-600 to-pink-700 rounded-xl flex items-center justify-center flex-shrink-0 text-white text-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-link"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-3 text-gray-900 dark:text-white">Social</h4>
                                <div class="flex gap-4">
                                    <a href="#" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline transition"><i class="fab fa-github mr-2"></i>GitHub</a>
                                    <a href="#" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline transition"><i class="fab fa-linkedin mr-2"></i>LinkedIn</a>
                                    <a href="#" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline transition"><i class="fab fa-twitter mr-2"></i>Twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
