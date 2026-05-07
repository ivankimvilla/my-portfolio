<style>
    .admin-sidebar {
        width: 280px;
        height: 100vh;
        background: rgba(10, 14, 22, 0.96);
        padding: 32px 24px;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        position: fixed;
        top: 0;
        left: 0;
        overflow: hidden;
        backdrop-filter: blur(18px);
        z-index: 40;
    }

    .admin-sidebar::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 12%, rgba(200, 169, 110, 0.08), transparent 24%),
                    radial-gradient(circle at 85% 82%, rgba(255, 255, 255, 0.04), transparent 20%);
        pointer-events: none;
    }

    .sidebar-brand {
        position: relative;
        z-index: 1;
    }

    .sidebar-brand-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        color: rgba(200, 169, 110, 0.8);
        margin-bottom: 10px;
    }

    .sidebar-brand-eyebrow::before {
        content: '';
        width: 22px;
        height: 1px;
        background: #c8a96e;
        opacity: 0.65;
    }

    .sidebar-brand-title {
        font-size: 2rem;
        line-height: 1.05;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: #f8fafc;
    }

    .sidebar-brand-title em {
        font-style: normal;
        color: #c8a96e;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        position: relative;
        z-index: 1;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        border-radius: 18px;
        border: 1px solid transparent;
        color: rgba(248, 250, 252, 0.78);
        text-decoration: none;
        transition: transform .2s ease, background .2s ease, border-color .2s ease, color .2s ease;
        background: rgba(255, 255, 255, 0.02);
    }

    .sidebar-link:hover {
        transform: translateX(2px);
        background: rgba(200, 169, 110, 0.12);
        color: #f8fafc;
        border-color: rgba(200, 169, 110, 0.18);
    }

    .sidebar-link.active {
        background: rgba(200, 169, 110, 0.16);
        color: #f8fafc;
        border-color: rgba(200, 169, 110, 0.22);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .sidebar-link {
        position: relative;
    }

    .sidebar-link-icon {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        color: rgba(248, 250, 252, 0.72);
        font-size: 16px;
        transition: transform .2s ease, background .2s ease, border-color .2s ease, color .2s ease;
        position: relative;
    }

    .sidebar-link:hover .sidebar-link-icon,
    .sidebar-link.active .sidebar-link-icon {
        transform: translateX(1px);
        background: rgba(200, 169, 110, 0.16);
        border-color: rgba(200, 169, 110, 0.22);
        color: #c8a96e;
    }

    .sidebar-notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        line-height: 1;
    }

    @media (max-width: 1024px) {
        .admin-sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }
    }
</style>

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
    </nav>
</aside>