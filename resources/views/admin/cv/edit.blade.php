<x-layouts.portfolio title="Manage CV — Ivan Kim Almadin" page-css="css/admin/admin.css" body-class="portfolio-admin" :show-header="false" :show-footer="false">
  <div class="admin-dashboard">
    <aside class="admin-sidebar">
      <a class="admin-logo" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home"><span>IK</span></a>
      <nav aria-label="Admin navigation">
        <a href="{{ route('admin.works.index') }}"><span aria-hidden="true">▦</span> Works</a>
        <a class="selected" href="{{ route('admin.cv.edit') }}"><span aria-hidden="true">⇩</span> CV</a>
        <a href="{{ route('admin.account-settings.edit') }}"><span aria-hidden="true">⚙</span> Account settings</a>
      </nav>
      <form class="admin-logout-form" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-logout-button" type="submit">Sign out</button></form>
    </aside>

    <main class="admin-main">
      <header class="admin-heading"><div><h1>Manage CV</h1><p>Upload the PDF visitors can download from your About Me page.</p></div></header>

      @if (session('status'))
        <p class="admin-notice" role="status">{{ session('status') }}</p>
      @endif

      @if ($errors->any())
        <div class="admin-validation-errors" role="alert">
          <p>Please correct the following fields:</p>
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      <form class="work-admin-form account-settings-form" method="POST" action="{{ route('admin.cv.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="work-form-grid">
          <div class="work-form-wide cv-upload-status">
            <strong>{{ $cvAvailable ? 'A CV is currently available for download.' : 'No CV has been uploaded yet.' }}</strong>
            <span>Choose a PDF file up to 10 MB. Uploading another file replaces the current CV.</span>
          </div>
          <label class="work-form-wide" for="cv">CV PDF
            <input id="cv" name="cv" type="file" accept="application/pdf,.pdf" required>
          </label>
        </div>
        <div class="work-form-actions">
          <a class="btn btn-light" href="{{ route('admin.works.index') }}">Cancel</a>
          <button class="btn" type="submit">Upload CV</button>
        </div>
      </form>

      @if ($cvAvailable)
        <section class="cv-preview" aria-labelledby="cv-preview-title">
          <header>
            <h2 id="cv-preview-title">Current CV</h2>
            <a href="{{ route('cv.view') }}" target="_blank" rel="noopener">Open full size</a>
          </header>
          <iframe src="{{ route('cv.view') }}" title="Preview of the uploaded CV"></iframe>
        </section>
      @endif
    </main>
  </div>
</x-layouts.portfolio>