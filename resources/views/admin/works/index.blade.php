<x-layouts.portfolio title="Works Management — Ivan Kim Almadin" page-css="css/admin/admin.css" body-class="portfolio-admin" :show-header="false" :show-footer="false">
  <div class="admin-dashboard">
    <aside class="admin-sidebar">
      <a class="admin-logo" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home"><span>IK</span></a>
      <nav aria-label="Admin navigation">
        <a class="selected" href="{{ route('admin.works.index') }}"><span aria-hidden="true">▦</span> Works</a>
        <a href="{{ route('admin.cv.edit') }}"><span aria-hidden="true">⇩</span> CV</a>
        <a href="{{ route('admin.account-settings.edit') }}"><span aria-hidden="true">⚙</span> Account settings</a>
      </nav>
      <form class="admin-logout-form" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-logout-button" type="submit">Sign out</button></form>
    </aside>

    <main class="admin-main">
      <header class="admin-heading">
        <div><h1>Works Management</h1><p>Create, edit, publish, and organize portfolio projects.</p></div>
        <a class="btn" href="{{ route('admin.works.create') }}">＋ Add Work</a>
      </header>

      @if (session('status'))
        <p class="admin-notice" role="status">{{ session('status') }}</p>
      @endif

      <div class="admin-table-wrap">
        <table class="admin-table">
          <thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
          <tbody>
            @forelse ($works as $work)
              <tr>
                <td><img class="admin-work-image" src="{{ route('works.image', $work) }}" alt="" loading="lazy"></td>
                <td><strong>{{ $work->title }}</strong><small class="admin-work-slug">/{{ $work->slug }}</small></td>
                <td>{{ $work->category ?: '—' }}</td>
                <td><span class="work-status work-status--{{ $work->status }}">{{ ucfirst($work->status) }}</span></td>
                <td>{{ $work->sort_order }}</td>
                <td>
                  <div class="admin-actions">
                    <a class="admin-action-link" href="{{ route('admin.works.edit', $work) }}" aria-label="Edit {{ $work->title }}" title="Edit">✎</a>
                    <form method="POST" action="{{ route('admin.works.destroy', $work) }}" onsubmit="return confirm('Delete this work?')">
                      @csrf
                      @method('DELETE')
                      <button class="delete" type="submit" aria-label="Delete {{ $work->title }}" title="Delete">×</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td class="admin-empty" colspan="6">No works yet. Add your first project to get started.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="admin-pagination">{{ $works->links() }}</div>
      <p class="admin-count">{{ $works->total() }} {{ Str::plural('work', $works->total()) }}</p>
    </main>
  </div>
</x-layouts.portfolio>