@extends('layouts.admin')

@section('header', 'Certificates Management')

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

    .cert-wrap { font-family: 'Outfit', sans-serif; }

    /* ── HEADER ROW ── */
    .cert-header {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .cert-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 6px;
    }
    .cert-eyebrow::before {
        content: ''; display: block;
        width: 20px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .cert-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px; font-weight: 300;
        letter-spacing: -0.5px; color: var(--text);
        line-height: 1.1;
    }
    .cert-title em { font-style: italic; color: var(--accent); }

    /* Add button */
    .cert-add-btn {
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
    .cert-add-btn::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.18), rgba(200,169,110,.06));
        opacity: 0; transition: opacity .25s;
    }
    .cert-add-btn:hover {
        border-color: var(--accent2);
        box-shadow: 0 0 24px rgba(200,169,110,.15);
        transform: translateY(-1px);
    }
    .cert-add-btn:hover::before { opacity: 1; }
    .cert-add-btn span { position: relative; z-index: 1; }

    /* ── TABLE CARD ── */
    .cert-table-wrap {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 32px rgba(0,0,0,.35);
    }

    /* Top accent rule */
    .cert-table-wrap::before {
        content: '';
        position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18; z-index: 1;
    }

    .cert-table { width: 100%; border-collapse: collapse; }

    .cert-table thead tr {
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
    }

    .cert-table th {
        padding: 14px 24px;
        text-align: left;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
    }
    .cert-table th:last-child { text-align: right; }

    .cert-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .2s;
    }
    .cert-table tbody tr:last-child { border-bottom: none; }
    .cert-table tbody tr:hover { background: rgba(200,169,110,.03); }

    .cert-table td { padding: 18px 24px; font-size: 14px; color: var(--text); }
    .cert-table td:last-child { text-align: right; }

    .cert-td-title { font-weight: 600; color: var(--text); margin-bottom: 3px; }
    .cert-td-issuer { font-size: 12px; color: var(--muted2); }

    /* Status badges */
    .cert-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.8px;
    }
    .cert-badge::before {
        content: ''; display: block;
        width: 5px; height: 5px; border-radius: 50%;
    }
    .cert-badge-active {
        background: rgba(34,197,94,.1);
        border: 1px solid rgba(34,197,94,.25);
        color: #86efac;
    }
    .cert-badge-active::before { background: #4ade80; }

    .cert-badge-inactive {
        background: rgba(255,255,255,.04);
        border: 1px solid var(--border);
        color: var(--muted2);
    }
    .cert-badge-inactive::before { background: var(--muted2); }

    .cert-date { font-size: 12px; color: var(--muted2); }

    /* Action buttons */
    .cert-actions { display: flex; gap: 8px; justify-content: flex-end; }

    .cert-btn-edit {
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
    .cert-btn-edit:hover {
        background: rgba(200,169,110,.15);
        border-color: rgba(200,169,110,.45);
        transform: translateY(-1px);
    }

    .cert-btn-delete {
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
    .cert-btn-delete:hover {
        background: rgba(239,68,68,.15);
        border-color: rgba(239,68,68,.4);
        transform: translateY(-1px);
    }

    /* Empty state */
    .cert-empty {
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
    .cert-empty i {
        font-size: 36px;
        color: var(--accent);
        opacity: .28;
        margin-bottom: 18px;
    }

    /* Pagination */
    .cert-pagination { margin-top: 28px; }
</style>

<div class="cert-wrap">

    <div class="cert-header">
        <div>
            <div class="cert-eyebrow">Management</div>
            <h1 class="cert-title">Professional <em>Certificates</em></h1>
        </div>
        <a href="{{ route('admin.certificates.create') }}" class="cert-add-btn">
            <span><i class="fas fa-plus" style="margin-right:4px;"></i> Add Certificate</span>
        </a>
    </div>

    <div class="cert-table-wrap">
        <table class="cert-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Issuer</th>
                    <th>Status</th>
                    <th>Issue Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $certificate)
                <tr>
                    <td>
                        <div class="cert-td-title">{{ $certificate->title }}</div>
                        <div class="cert-td-issuer">{{ $certificate->issuer }}</div>
                    </td>
                    <td>{{ $certificate->issuer }}</td>
                    <td>
                        @if($certificate->is_active)
                            <span class="cert-badge cert-badge-active">Active</span>
                        @else
                            <span class="cert-badge cert-badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td class="cert-date">{{ $certificate->issue_date->format('M d, Y') }}</td>
                    <td>
                        <div class="cert-actions">
                            <a href="{{ route('admin.certificates.edit', $certificate) }}" class="cert-btn-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cert-btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 0; border-bottom: none;">
                        <div class="cert-empty">
                            <i class="fas fa-certificate"></i>
                            No certificates yet. Create one to get started!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="cert-pagination">
        {{ $certificates->links() }}
    </div>

</div>
@endsection