<form class="work-admin-form {{ $work->exists ? 'work-admin-form--edit' : 'work-admin-form--create' }}" method="POST" action="{{ $work->exists ? route('admin.works.update', $work) : route('admin.works.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($work->exists)
    @method('PUT')
  @endif
  <a class="work-form-close" href="{{ route('admin.works.index') }}" aria-label="Close {{ $work->exists ? 'Edit' : 'Add' }} Work form" title="Close">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18"/></svg>
  </a>

  @if ($errors->any())
    <div class="admin-validation-errors" role="alert">
      <p>Please correct the following fields:</p>
      <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="work-form-grid">
    <label>Title
      <input name="title" type="text" value="{{ old('title', $work->title) }}" maxlength="255" required>
    </label>
    <label class="work-form-wide">Short description
      <textarea name="short_description" rows="3" maxlength="500" required>{{ old('short_description', $work->short_description) }}</textarea>
    </label>
    <label>Category
      <select name="category" required>
        @if ($work->category && ! in_array($work->category, ['Web Development', 'UI/UX Design'], true))
          <option value="{{ $work->category }}" @selected(old('category', $work->category) === $work->category)>{{ $work->category }}</option>
        @endif
        <option value="Web Development" @selected(old('category', $work->category) === 'Web Development')>Web Development</option>
        <option value="UI/UX Design" @selected(old('category', $work->category) === 'UI/UX Design')>UI/UX Design</option>
      </select>
    </label>
    <label>Tools <span class="field-optional">Optional, comma-separated</span>
      <input name="tools" type="text" value="{{ old('tools', implode(', ', $work->tools ?? [])) }}" maxlength="1000" placeholder="e.g. Laravel, PHP, MySQL">
    </label>
    <label>Project URL
      <input name="project_url" type="url" value="{{ old('project_url', $work->project_url) }}" maxlength="2048" placeholder="https://example.com">
    </label>
    <label>Sort order
      <input name="sort_order" type="number" min="0" max="4294967295" value="{{ old('sort_order', $work->sort_order ?? 0) }}" required>
    </label>
  </div>

  <div class="work-image-field">
    <label for="work-image">Project image{{ $work->exists ? ' (leave empty to keep the current image)' : '' }}</label>
    @if ($work->exists)
      <img class="work-image-preview" id="work-image-preview" src="{{ route('works.image', $work) }}" alt="Current image for {{ $work->title }}">
    @else
      <img class="work-image-preview" id="work-image-preview" alt="Selected image preview" hidden>
    @endif
    <input id="work-image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" @required(!$work->exists)>
    <small>JPG, PNG, or WebP. Maximum file size: 2 MB.</small>
  </div>

  <div class="work-image-field">
    <label for="work-gallery-images">Additional project images <span class="field-optional">Up to 3 at a time</span></label>
    @if ($work->exists && $work->galleryImages->isNotEmpty())
      <div class="work-gallery-image-previews">
        @foreach ($work->galleryImages as $index => $galleryImage)
          <img src="{{ route('works.gallery-image', [$work, $galleryImage]) }}" alt="Saved project image {{ $index + 2 }}">
        @endforeach
      </div>
    @endif
    <input id="work-gallery-images" name="gallery_images[]" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" multiple>
    <small>JPG, PNG, or WebP. Maximum file size: 2 MB per image.</small>
  </div>

  <div class="work-form-actions">
    <a class="btn btn-light" href="{{ route('admin.works.index') }}">Cancel</a>
    <button class="btn" type="submit">{{ $work->exists ? 'Save Changes' : 'Create Work' }}</button>
  </div>
</form>