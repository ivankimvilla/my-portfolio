<aside class="w-64 bg-gray-900 border-r border-gray-800 p-6 overflow-y-auto">
    <div class="mb-12">
        <h1 class="text-2xl font-bold">
            <span class="text-blue-600">Admin</span> Panel
        </h1>
    </div>

    <nav class="space-y-2">
        <a href="/admin/projects" class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->is('admin/projects*') ? 'bg-blue-600' : '' }}">
            📁 Projects
        </a>
        <a href="/admin/services" class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->is('admin/services*') ? 'bg-blue-600' : '' }}">
            🚀 Services
        </a>
        <a href="/admin/inquiries" class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->is('admin/inquiries*') ? 'bg-blue-600' : '' }}">
            📧 Inquiries
        </a>
        <a href="/admin/profile" class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->is('admin/profile*') ? 'bg-blue-600' : '' }}">
            🔐 Account
        </a>
        <hr class="my-4 border-gray-800">
        <a href="/" class="block px-4 py-2 rounded-lg hover:bg-gray-800 transition text-gray-400">
            ← Back to Portfolio
        </a>
    </nav>
</aside>
