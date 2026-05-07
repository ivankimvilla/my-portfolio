@extends('layouts.admin')

@section('header', 'Projects Management')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

    :root {
        --bg:      #0b0c0e;
        --surface: #111316;
        --surface2:#161820;
        --border:  rgba(255,255,255,.07);
        --border2: rgba(200,169,110,.25);
        --accent:  #c8a96e;
        --accent2: #e8c98a;
        --text:    #f0ece4;
        --muted:   rgba(240,236,228,.55);
        --muted2:  rgba(240,236,228,.32);
    }

    .proj-wrap { font-family: 'Outfit', sans-serif; }

    /* ── HEADER ROW ── */
    .proj-header {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .proj-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 6px;
    }
    .proj-eyebrow::before {
        content: ''; display: block;
        width: 20px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .proj-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px; font-weight: 300;
        letter-spacing: -0.5px; color: var(--text);
        line-height: 1.1;
    }
    .proj-title em { font-style: italic; color: var(--accent); }

    /* Add button */
    .proj-add-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 24px;
        background: transparent;
        border: 1px solid rgba(200,169,110,.5);
        border-radius: 10px;
        color: var(--accent2);
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.5px;
        text-decoration: none;
        position: relative; overflow: hidden;
        transition: border-color .25s, box-shadow .25s, transform .15s;
    }
    .proj-add-btn::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .proj-add-btn:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.15);
        transform: translateY(-1px);
    }
    .proj-add-btn:hover::before { opacity: 1; }
    .proj-add-btn span { position: relative; z-index: 1; }

    /* ── TABLE CARD ── */
    .proj-table-wrap {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 32px rgba(0,0,0,.35);
    }

    /* Top accent rule */
    .proj-table-wrap::before {
        content: '';
        position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18; z-index: 1;
    }

    .proj-table { width: 100%; border-collapse: collapse; }

    .proj-table thead tr {
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
    }

    .proj-table th {
        padding: 14px 24px;
        text-align: left;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
    }
    .proj-table th:last-child { text-align: right; }

    .proj-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .2s;
    }
    .proj-table tbody tr:last-child { border-bottom: none; }
    .proj-table tbody tr:hover { background: rgba(200,169,110,.03); }

    .proj-table td { padding: 18px 24px; font-size: 14px; color: var(--text); }
    .proj-table td:last-child { text-align: right; }

    .proj-td-title { font-weight: 600; color: var(--text); margin-bottom: 3px; }
    .proj-td-slug  { font-size: 12px; color: var(--muted2); }

    /* Status badges */
    .proj-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.8px;
    }
    .proj-badge::before {
        content: ''; display: block;
        width: 5px; height: 5px; border-radius: 50%;
    }
    .proj-badge-active {
        background: rgba(34,197,94,.1);
        border: 1px solid rgba(34,197,94,.25);
        color: #86efac;
    }
    .proj-badge-active::before { background: #4ade80; }

    .proj-badge-inactive {
        background: rgba(255,255,255,.04);
        border: 1px solid var(--border);
        color: var(--muted2);
    }
    .proj-badge-inactive::before { background: var(--muted2); }

    /* Featured */
    .proj-featured-yes { color: var(--accent2); font-size: 13px; }
    .proj-featured-no  { color: var(--muted2);  font-size: 13px; }

    .proj-date { font-size: 12px; color: var(--muted2); }

    /* Action buttons */
    .proj-actions { display: flex; gap: 8px; justify-content: flex-end; }

    .proj-btn-edit {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 14px;
        background: rgba(200,169,110,.08);
        border: 1px solid rgba(200,169,110,.25);
        border-radius: 8px;
        color: var(--accent2);
        font-size: 12px; font-weight: 500;
        text-decoration: none;
        transition: background .2s, border-color .2s, transform .15s;
    }
    .proj-btn-edit:hover {
        background: rgba(200,169,110,.15);
        border-color: rgba(200,169,110,.45);
        transform: translateY(-1px);
    }

    .proj-btn-delete {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 14px;
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.2);
        border-radius: 8px;
        color: #fca5a5;
        font-size: 12px; font-weight: 500;
        cursor: pointer;
        font-family: 'Outfit', sans-serif;
        transition: background .2s, border-color .2s, transform .15s;
    }
    .proj-btn-delete:hover {
        background: rgba(239,68,68,.15);
        border-color: rgba(239,68,68,.4);
        transform: translateY(-1px);
    }

    /* Empty state */
    .proj-empty {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        padding: 80px 24px;
        text-align: center;
        color: var(--muted2);
        font-size: 15px;
        letter-spacing: 0.02em;
        margin: 0 auto;
    }
    .proj-empty i {
        font-size: 36px;
        color: var(--accent);
        opacity: .28;
        margin-bottom: 18px;
    }

    /* Pagination */
    .proj-pagination { margin-top: 28px; }
</style>

<div class="proj-wrap">

    <div class="proj-header">
        <div>
            <div class="proj-eyebrow">Management</div>
            <h1 class="proj-title">Featured <em>Projects</em></h1>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="proj-add-btn">
            <span><i class="fas fa-plus" style="margin-right:4px;"></i> Add Project</span>
        </a>
    </div>

    <div class="proj-table-wrap">
        <table class="proj-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <div class="proj-td-title">{{ $project->title }}</div>
                        <div class="proj-td-slug">{{ $project->slug }}</div>
                    </td>
                    <td>
                        @if($project->is_active)
                            <span class="proj-badge proj-badge-active">Active</span>
                        @else
                            <span class="proj-badge proj-badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if($project->is_featured)
                            <span class="proj-featured-yes"><i class="fas fa-star" style="margin-right:5px;"></i>Yes</span>
                        @else
                            <span class="proj-featured-no"><i class="fas fa-times" style="margin-right:5px;"></i>No</span>
                        @endif
                    </td>
                    <td class="proj-date">{{ $project->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="proj-actions">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="proj-btn-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="proj-btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 0; border-bottom: none;">
                        <div class="proj-empty">
                            <i class="fas fa-folder-open"></i>
                            No projects yet. Create one to get started!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="proj-pagination">
        {{ $projects->links() }}
    </div>

</div>
@endsection