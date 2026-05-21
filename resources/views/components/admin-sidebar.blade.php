
<link rel="stylesheet" href="{{ asset('css/components/admin-sidebar.css') }}">

<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-eyebrow">Ivan Kim Almadin</div>
        <div class="sidebar-brand-title"><em>Admin</em> Panel</div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.projects.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-folder-open"></i></span>
            <span>Projects</span>
        </a>

        <a href="{{ route('admin.services.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-rocket"></i></span>
            <span>Services</span>
        </a>

        <a href="{{ route('admin.certificates.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-certificate"></i></span>
            <span>Certificates</span>
        </a>

        <a href="{{ route('admin.resume.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.resume') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-file-upload"></i></span>
            <span>Resume</span>
        </a>

        <a href="{{ route('admin.inquiries.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
            <span class="sidebar-link-icon">
                <i class="fas fa-envelope"></i>
                @php
                    $unreadCount = \App\Models\Inquiry::where('status', 'new')->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="sidebar-notification-badge">{{ $unreadCount }}</span>
                @endif
            </span>
            <span>Inquiries</span>
        </a>

        <a href="{{ route('admin.profile') }}"
           class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-user-circle"></i></span>
            <span>Account</span>
        </a>

        <a href="{{ route('admin.profile.skills') }}"
           class="sidebar-link {{ request()->routeIs('admin.profile.skills') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-brain"></i></span>
            <span>Skills</span>
        </a>

        <a href="{{ route('admin.profile.stats') }}"
           class="sidebar-link {{ request()->routeIs('admin.profile.stats') ? 'active' : '' }}">
            <span class="sidebar-link-icon"><i class="fas fa-chart-line"></i></span>
            <span>Stats</span>
        </a>
    </nav>
</aside>