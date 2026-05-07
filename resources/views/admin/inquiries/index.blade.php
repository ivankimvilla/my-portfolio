@extends('layouts.admin')

@section('header', 'Inquiries')

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
        --status-new-bg:        rgba(96,165,250,.10);
        --status-new-border:    rgba(96,165,250,.28);
        --status-new-color:     #93c5fd;
        --status-new-dot:       #60a5fa;
        --status-read-bg:       rgba(251,191,36,.10);
        --status-read-border:   rgba(251,191,36,.25);
        --status-read-color:    #fde68a;
        --status-read-dot:      #fbbf24;
        --status-resp-bg:       rgba(34,197,94,.10);
        --status-resp-border:   rgba(34,197,94,.25);
        --status-resp-color:    #86efac;
        --status-resp-dot:      #4ade80;
    }

    .inq-wrap { font-family: 'Outfit', sans-serif; }

    /* ── HEADER ── */
    .inq-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .inq-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 6px;
    }
    .inq-eyebrow::before {
        content: ''; display: block;
        width: 20px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .inq-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px; font-weight: 300;
        letter-spacing: -0.5px; color: var(--text);
        line-height: 1.1;
    }
    .inq-title em { font-style: italic; color: var(--accent); }

    /* ── TABLE CARD ── */
    .inq-table-wrap {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 32px rgba(0,0,0,.35);
    }

    .inq-table-wrap::before {
        content: '';
        position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .18; z-index: 1;
    }

    .inq-table { width: 100%; border-collapse: collapse; }

    .inq-table thead tr {
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
    }

    .inq-table th {
        padding: 14px 24px;
        text-align: left;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent);
    }
    .inq-table th:last-child { text-align: right; }

    .inq-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .2s;
    }
    .inq-table tbody tr:last-child { border-bottom: none; }
    .inq-table tbody tr:hover { background: rgba(200,169,110,.03); }

    .inq-table td { padding: 18px 24px; font-size: 14px; color: var(--text); }
    .inq-table td:last-child { text-align: right; }

    /* Sender cell */
    .inq-td-name { font-weight: 600; color: var(--text); margin-bottom: 3px; }
    .inq-td-email { font-size: 12px; color: var(--muted2); }

    /* Date */
    .inq-date { font-size: 12px; color: var(--muted2); }

    /* ── STATUS BADGES ── */
    .inq-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.8px;
    }
    .inq-badge::before {
        content: ''; display: block;
        width: 5px; height: 5px; border-radius: 50%;
    }

    .inq-badge-new {
        background: var(--status-new-bg);
        border: 1px solid var(--status-new-border);
        color: var(--status-new-color);
    }
    .inq-badge-new::before { background: var(--status-new-dot); }

    .inq-badge-read {
        background: var(--status-read-bg);
        border: 1px solid var(--status-read-border);
        color: var(--status-read-color);
    }
    .inq-badge-read::before { background: var(--status-read-dot); }

    .inq-badge-responded {
        background: var(--status-resp-bg);
        border: 1px solid var(--status-resp-border);
        color: var(--status-resp-color);
    }
    .inq-badge-responded::before { background: var(--status-resp-dot); }

    /* ── ACTION BUTTONS ── */
    .inq-actions { display: flex; gap: 8px; justify-content: flex-end; }

    .inq-btn-view {
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
    .inq-btn-view:hover {
        background: rgba(200,169,110,.15);
        border-color: rgba(200,169,110,.45);
        transform: translateY(-1px);
    }

    .inq-btn-delete {
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
    .inq-btn-delete:hover {
        background: rgba(239,68,68,.15);
        border-color: rgba(239,68,68,.4);
        transform: translateY(-1px);
    }

    /* ── EMPTY STATE ── */
    .inq-empty {
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
    }
    .inq-empty i {
        font-size: 36px;
        color: var(--accent);
        opacity: .28;
        margin-bottom: 18px;
    }

    /* ── PAGINATION ── */
    .inq-pagination { margin-top: 28px; }
</style>

<div class="inq-wrap">

    <div class="inq-header">
        <div>
            <div class="inq-eyebrow">Inbox</div>
            <h1 class="inq-title">Contact Form <em>Inquiries</em></h1>
        </div>
    </div>

    <div class="inq-table-wrap">
        <table class="inq-table">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                <tr>
                    <td>
                        <div class="inq-td-name">{{ $inquiry->name }}</div>
                        <div class="inq-td-email">{{ $inquiry->email }}</div>
                    </td>
                    <td>
                        @php
                            $badgeClass = match($inquiry->status) {
                                'responded' => 'inq-badge-responded',
                                'read'      => 'inq-badge-read',
                                default     => 'inq-badge-new',
                            };
                        @endphp
                        <span class="inq-badge {{ $badgeClass }}">{{ ucfirst($inquiry->status) }}</span>
                    </td>
                    <td class="inq-date">{{ $inquiry->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <div class="inq-actions">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="inq-btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" id="delete-form-{{ $inquiry->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="inq-btn-delete" onclick="openDeleteModal({{ $inquiry->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 0; border-bottom: none;">
                        <div class="inq-empty">
                            <i class="fas fa-envelope-open"></i>
                            No inquiries yet. They'll appear here when someone reaches out.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="inq-pagination">
        {{ $inquiries->links() }}
    </div>

</div>

{{-- ── CUSTOM DELETE MODAL ── --}}
<div id="delete-modal" style="display:none;" aria-modal="true" role="dialog">
    <div class="del-backdrop" onclick="closeDeleteModal()"></div>
    <div class="del-dialog">
        <div class="del-icon-wrap">
            <div class="del-icon-ring">
                <i class="fas fa-trash del-icon"></i>
            </div>
        </div>
        <h2 class="del-heading">Delete Inquiry</h2>
        <p class="del-body">This inquiry will be permanently removed and cannot be recovered. Are you sure you want to continue?</p>
        <div class="del-actions">
            <button class="del-btn del-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="del-btn del-btn-confirm" id="del-confirm-btn">
                <i class="fas fa-trash" style="font-size:11px;"></i> Delete
            </button>
        </div>
    </div>
</div>

<style>
    .del-backdrop {
        position: fixed; inset: 0;
        background: rgba(5,6,8,.82);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        z-index: 998;
        animation: delFadeIn .2s ease;
    }
    .del-dialog {
        position: fixed;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;
        width: 100%; max-width: 420px;
        background: #111316;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 20px;
        padding: 40px 36px 32px;
        text-align: center;
        box-shadow: 0 24px 80px rgba(0,0,0,.65), 0 0 0 1px rgba(200,169,110,.06);
        animation: delSlideUp .22s cubic-bezier(.34,1.36,.64,1);
    }
    .del-dialog::before {
        content: '';
        position: absolute; top: 0; left: 15%; right: 15%; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(239,68,68,.5), transparent);
        border-radius: 1px;
    }
    .del-icon-wrap { display: flex; justify-content: center; margin-bottom: 22px; }
    .del-icon-ring {
        width: 60px; height: 60px; border-radius: 50%;
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.22);
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 28px rgba(239,68,68,.1);
    }
    .del-icon { font-size: 20px; color: #fca5a5; }
    .del-heading {
        font-family: 'Cormorant Garamond', serif;
        font-size: 24px; font-weight: 400;
        color: #f0ece4; margin: 0 0 12px; letter-spacing: -0.2px;
    }
    .del-body {
        font-family: 'Outfit', sans-serif;
        font-size: 14px; line-height: 1.65;
        color: rgba(240,236,228,.45); margin: 0 0 28px;
    }
    .del-actions { display: flex; gap: 10px; }
    .del-btn {
        flex: 1; padding: 11px 0; border-radius: 10px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer; border: 1px solid transparent;
        transition: background .2s, border-color .2s, transform .15s, box-shadow .2s;
    }
    .del-btn:hover { transform: translateY(-1px); }
    .del-btn-cancel {
        background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.09);
        color: rgba(240,236,228,.6);
    }
    .del-btn-cancel:hover {
        background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.15);
        color: rgba(240,236,228,.9);
    }
    .del-btn-confirm {
        background: rgba(239,68,68,.12); border-color: rgba(239,68,68,.3); color: #fca5a5;
        display: inline-flex; align-items: center; justify-content: center; gap: 7px;
    }
    .del-btn-confirm:hover {
        background: rgba(239,68,68,.2); border-color: rgba(239,68,68,.55);
        box-shadow: 0 4px 18px rgba(239,68,68,.15); color: #fecaca;
    }
    @keyframes delFadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes delSlideUp {
        from { opacity: 0; transform: translate(-50%, calc(-50% + 16px)); }
        to   { opacity: 1; transform: translate(-50%, -50%); }
    }
</style>

<script>
    let _deleteTargetId = null;
    function openDeleteModal(id) {
        _deleteTargetId = id;
        document.getElementById('delete-modal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('delete-modal').style.display = 'none';
        document.body.style.overflow = '';
        _deleteTargetId = null;
    }
    document.getElementById('del-confirm-btn').addEventListener('click', function() {
        if (_deleteTargetId) {
            document.getElementById('delete-form-' + _deleteTargetId).submit();
        }
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endsection