@extends('layouts.app')

@section('title', 'About Me - Full Stack Developer')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">
    <!-- About Hero -->
    <section class="mb-20">
        <h1 class="text-5xl font-bold mb-8">About Me</h1>
        <div class="grid md:grid-cols-2 gap-12">
            <div>
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl h-96"></div>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-6">I'm a Full-Stack Developer</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
                    With over 5 years of experience in web development, I specialize in building scalable, user-friendly applications that solve real business problems. My passion is turning complex requirements into elegant, maintainable code.
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
                    I believe in clean architecture, continuous learning, and delivering products that exceed expectations. I've worked with startups and established companies, always bringing a solution-oriented mindset.
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                    When I'm not coding, you'll find me contributing to open-source projects, writing technical blogs, or exploring new technologies.
                </p>
                <a href="/portfolio" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    View My Work
                </a>
            </div>
        </div>
    </section>

    <!-- Skills & Experience -->
    <section class="mb-20">
        <h2 class="text-4xl font-bold mb-12">Technical Expertise</h2>
        <div class="grid md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-xl font-bold mb-6">Professional Skills</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Backend Development</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">95%</span>
                        </div>
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600" style="width: 95%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Frontend Development</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">85%</span>
                        </div>
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-purple-600" style="width: 85%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Database Design</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">90%</span>
                        </div>
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-green-600" style="width: 90%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">DevOps & Deployment</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">80%</span>
                        </div>
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-orange-600" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-6">Work Experience</h3>
                <div class="space-y-6">
                    <div class="border-l-4 border-blue-600 pl-4">
                        <h4 class="font-bold text-lg">Senior Developer</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Tech Startup Inc. | 2023 - Present</p>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Led development of microservices architecture serving 100k+ users</p>
                    </div>
                    <div class="border-l-4 border-purple-600 pl-4">
                        <h4 class="font-bold text-lg">Full Stack Developer</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Digital Agency Co. | 2021 - 2023</p>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Developed 15+ web applications for diverse clients</p>
                    </div>
                    <div class="border-l-4 border-green-600 pl-4">
                        <h4 class="font-bold text-lg">Junior Developer</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Web Solutions Ltd. | 2020 - 2021</p>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Started my journey with PHP and MySQL applications</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications & Achievements -->
    <section class="mb-20 bg-gray-50 dark:bg-gray-900 rounded-2xl p-12">
        <h2 class="text-4xl font-bold mb-12 text-center">Certifications & Achievements</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-5xl mb-4">🏆</div>
                <h3 class="font-bold text-lg mb-2">5+ Years Experience</h3>
                <p class="text-gray-600 dark:text-gray-400">Building professional web solutions</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">📚</div>
                <h3 class="font-bold text-lg mb-2">50+ Projects</h3>
                <p class="text-gray-600 dark:text-gray-400">Delivered across different industries</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">⭐</div>
                <h3 class="font-bold text-lg mb-2">100% Satisfaction</h3>
                <p class="text-gray-600 dark:text-gray-400">Client retention rate and positive reviews</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="text-center mb-20">
        <h2 class="text-4xl font-bold mb-6">Ready to collaborate?</h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">Let's discuss how I can help bring your project to life</p>
        <a href="/contact" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
            Get In Touch
        </a>
    </section>
</div>
@endsection
