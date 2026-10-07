<x-layouts.portfolio title="Admin Login — Ivan Kim Almadin" page-css="css/admin/admin.css" body-class="portfolio-admin-login" :show-header="false" :show-footer="false">
  <main class="admin-login-shell">
    <a class="admin-login-brand" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home">IK</a>
    <section class="admin-login-card" aria-labelledby="admin-login-title">
      <p class="admin-login-eyebrow">Portfolio Admin</p>
      <h1 id="admin-login-title">Sign in</h1>
      <p class="admin-login-description">Sign in to manage portfolio projects.</p>
      @if ($errors->has('email'))
        <p class="admin-login-error" role="alert">{{ $errors->first('email') }}</p>
      @endif
      <form class="admin-login-form" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label for="email">Email address
          <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
        </label>
        <label for="password">Password
          <input id="password" name="password" type="password" autocomplete="current-password" required>
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