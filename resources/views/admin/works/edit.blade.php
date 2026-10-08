<x-layouts.portfolio title="Edit {{ $work->title }} — Ivan Kim Almadin" page-css="css/admin/admin.css" page-js="js/admin/work-form.js" body-class="portfolio-admin" :show-header="false" :show-footer="false">
  <div class="admin-dashboard">
    <aside class="admin-sidebar">
      <a class="admin-logo" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home"><span>IK</span></a>
      <nav aria-label="Admin navigation">
        <a class="selected" href="{{ route('admin.works.index') }}"><span aria-hidden="true">▦</span> Works</a>
        <a href="{{ route('admin.account-settings.edit') }}"><span aria-hidden="true">⚙</span> Account settings</a>
      </nav>
      <form class="admin-logout-form" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-logout-button" type="submit">Sign out</button></form>
    </aside>
    <main class="admin-main">
      @if (session('status'))
        <p class="admin-notice" role="status">{{ session('status') }}</p>
      @endif
      @include('admin.works._form')
    </main>
  </div>
</x-layouts.portfolio>