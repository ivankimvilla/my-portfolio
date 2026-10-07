<x-layouts.portfolio title="Works Management — Ivan Kim Almadin" page-css="css/admin/admin.css" page-js="js/admin/admin.js" body-class="portfolio-admin" :show-header="false" :show-footer="false">
  <div class="admin-dashboard">
    <aside class="admin-sidebar"><a class="admin-logo" href="{{ route('home') }}" aria-label="Ivan Kim Almadin, home"><span>IK</span></a><nav aria-label="Admin navigation"><a class="selected" href="{{ route('admin') }}"><span aria-hidden="true">▦</span> Works</a><a href="{{ route('home') }}"><span aria-hidden="true">↪</span> Back to site</a></nav><form class="admin-logout-form" method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-logout-button" type="submit">Sign out</button></form></aside>
    <main class="admin-main">
      <header class="admin-heading"><div><h1>Works Management</h1><p>Manage your portfolio projects. Add, edit, or delete works.</p></div><button class="btn" type="button" id="add-work">＋ Add Work</button></header>
      <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Thumbnail</th><th>Title</th><th>Category</th><th>Tools</th><th>Featured</th><th>Actions</th></tr></thead><tbody id="admin-list"></tbody></table></div>
      <p class="admin-count" id="admin-count"></p>
    </main>
  </div>
  <div class="modal" id="work-modal" aria-hidden="true"><div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <button class="modal-close" id="close-modal" type="button" aria-label="Close dialog">×</button>
    <h2 id="modal-title">Add Work</h2><p class="modal-description" id="modal-description">Fill in the details to add a new project.</p>
    <form id="work-form">
      <input type="hidden" id="work-id">
      <label for="project-title">Project Title *</label><input id="project-title" type="text" placeholder="Enter project title" required>
      <label for="category">Category *</label><select id="category"><option>UI/UX Design</option><option>Web Development</option></select>
      <label for="description">Description *</label><textarea id="description" rows="3" placeholder="Enter project description" required></textarea>
      <label for="image-file">Project Image *</label><label class="upload-area" id="upload-area" for="image-file"><span id="upload-preview">Click to upload or drag and drop<br>PNG, JPG (max 5MB)</span><input id="image-file" type="file" accept="image/*"></label>
      <label for="tools">Tools / Technologies * <span>(comma separated)</span></label><input id="tools" type="text" placeholder="e.g. Laravel, PHP, MySQL" required>
      <label for="project-link">Project Link</label><input id="project-link" type="url" placeholder="https://example.com">
      <div class="featured-choice"><button class="switch" id="featured-toggle" type="button" aria-pressed="true" aria-label="Toggle featured on home"></button><label for="featured-toggle">Featured on Home</label></div>
      <div class="modal-actions"><button class="btn btn-light" type="button" id="cancel-modal">Cancel</button><button class="btn" id="save-work" type="submit">Add Work</button></div>
    </form>
  </div></div>
  <div class="toast" id="admin-toast" role="status" aria-live="polite"></div>
</x-layouts.portfolio>
