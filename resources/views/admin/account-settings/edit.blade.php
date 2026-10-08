<x-layouts.portfolio title="Account Settings — Ivan Kim Almadin" page-css="css/admin/admin.css" page-js="js/admin/account-settings.js" body-class="portfolio-admin" :show-header="false" :show-footer="false">
  <div class="admin-dashboard">
    <aside class="admin-sidebar">
      <a class="admin-logo" href="{{ route('admin') }}" aria-label="Works management"><span>IK</span></a>
      <nav aria-label="Admin navigation">
        <a href="{{ route('admin') }}"><span aria-hidden="true">▦</span> Works</a>
        <a class="selected" href="{{ route('admin.account-settings.edit') }}"><span aria-hidden="true">⚙</span> Account settings</a>
      </nav>
      <form class="admin-logout-form" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-logout-button" type="submit">Sign out</button></form>
    </aside>

    <main class="admin-main">
      <header class="admin-heading"><div><h1>Account Settings</h1><p>Change the email or password used to access the admin panel.</p></div></header>

      @if (session('status'))
        <p class="admin-notice" role="status">{{ session('status') }}</p>
      @endif

      @if ($errors->any())
        <div class="admin-validation-errors" role="alert">
          <p>Please correct the following fields:</p>
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      <form class="work-admin-form account-settings-form" method="POST" action="{{ route('admin.account-settings.update') }}">
        @csrf
        @method('PUT')
        <div class="work-form-grid">
          <label class="work-form-wide">Admin email
            <input name="email" type="email" value="{{ old('email', auth()->user()->email) }}" autocomplete="username" maxlength="255" required>
          </label>
          <label class="work-form-wide">Current password
            <span class="admin-password-field">
              <input id="current-password" name="current_password" type="password" autocomplete="current-password" placeholder="Current password" required>
              <button class="admin-settings-password-toggle" type="button" data-password-target="current-password" aria-label="Show current password" title="Show current password">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </span>
          </label>
          <label>New password
            <span class="admin-password-field">
              <input id="new-password" name="password" type="password" autocomplete="new-password" placeholder="New password" minlength="12">
              <button class="admin-settings-password-toggle" type="button" data-password-target="new-password" aria-label="Show new password" title="Show new password">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </span>
          </label>
          <label>Confirm new password
            <span class="admin-password-field">
              <input id="password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Confirm new password" minlength="12">
              <button class="admin-settings-password-toggle" type="button" data-password-target="password-confirmation" aria-label="Show password confirmation" title="Show password confirmation">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </span>
          </label>
        </div>
        <div class="work-form-actions">
          <a class="btn btn-light" href="{{ route('admin') }}">Cancel</a>
          <button class="btn" type="submit">Save Settings</button>
        </div>
      </form>
    </main>
  </div>
</x-layouts.portfolio>