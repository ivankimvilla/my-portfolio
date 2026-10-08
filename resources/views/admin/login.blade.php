<x-layouts.portfolio title="Admin Login — Ivan Kim Almadin" page-css="css/admin/login.css" page-js="js/admin/login.js" body-class="portfolio-admin-login" :show-header="false" :show-footer="false">
  <main class="admin-login-shell">
    <a class="admin-login-back" href="{{ route('home') }}">← Back to portfolio</a>
    <section class="admin-login-card" aria-labelledby="admin-login-title">
      <h1 id="admin-login-title">Sign in</h1>
      <p class="admin-login-description">Sign in to manage portfolio projects.</p>
      @if ($errors->has('email'))
        <p class="admin-login-error" role="alert">{{ $errors->first('email') }}</p>
      @endif
      <form class="admin-login-form" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label for="email">Email address
          <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" placeholder="example@gmail.com" required autofocus>
        </label>
        <label for="password">Password
          <div class="admin-password-wrap">
            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="password" required>
            <button type="button" class="admin-password-toggle" aria-label="Show password" title="Show password">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </label>
        <label class="admin-login-remember" for="remember">
          <input id="remember" name="remember" type="checkbox" value="1">
          Remember me
        </label>
        <button class="admin-login-submit" type="submit">Sign in</button>
      </form>
    </section>
    <a class="admin-login-back" href="{{ route('home') }}">← Back to portfolio</a>
  </main>

</x-layouts.portfolio>