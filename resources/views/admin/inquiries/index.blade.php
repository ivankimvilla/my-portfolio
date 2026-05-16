@extends('layouts.admin')

@section('header', 'Inquiries')
<link rel="stylesheet" href="{{ asset('css/admin/inquiries/index.css') }}">
@section('content')

<div class="inq-wrap">

    <div class="inq-header">
        <div>
            <div class="inq-eyebrow">Inbox</div>
            <h1 class="inq-title">Contact Form <em>Inquiries</em></h1>
        </div>
        <button id="bulk-delete-btn" class="inq-bulk-delete-btn" style="display: none;">
            <i class="fas fa-trash"></i> Delete Selected
        </button>
    </div>

    <div class="inq-table-wrap">
        <table class="inq-table">
            <thead>
                <tr>
                    @if ($inquiries->total() > 1)
                    <th style="width: 50px; padding: 14px 16px;">
                        <div class="inq-checkbox-wrapper">
                            <input type="checkbox" id="check-all" class="inq-checkbox">
                        </div>
                    </th>
                    @endif
                    <th>Sender</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="inquiries-tbody">
                @forelse($inquiries as $inquiry)
                <tr data-inquiry-id="{{ $inquiry->id }}">
                    @if ($inquiries->total() > 1)
                    <td style="padding: 18px 16px;">
                        <div class="inq-checkbox-wrapper">
                            <input type="checkbox" class="inq-checkbox inquiry-checkbox" value="{{ $inquiry->id }}">
                        </div>
                    </td>
                    @endif
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
                    <td colspan="5" style="padding: 0; border-bottom: none;">
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
        <h2 class="del-heading">Delete this inquiry?</h2>
        <p class="del-body">It cannot be recovered.</p>
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

    // Bulk delete functionality
    const checkAllCheckbox = document.getElementById('check-all');
    const inquiryCheckboxes = document.querySelectorAll('.inquiry-checkbox');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
    let _bulkDeleteTargetIds = [];

    function updateBulkDeleteButton() {
        _bulkDeleteTargetIds = Array.from(inquiryCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        bulkDeleteBtn.style.display = _bulkDeleteTargetIds.length > 0 ? 'inline-flex' : 'none';
    }

    if (checkAllCheckbox && inquiryCheckboxes.length > 0) {
        checkAllCheckbox.addEventListener('change', function() {
            inquiryCheckboxes.forEach(cb => cb.checked = this.checked);
            updateBulkDeleteButton();
        });

        inquiryCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                checkAllCheckbox.checked = Array.from(inquiryCheckboxes).every(c => c.checked);
                checkAllCheckbox.indeterminate = Array.from(inquiryCheckboxes).some(c => c.checked) &&
                                                 !Array.from(inquiryCheckboxes).every(c => c.checked);
                updateBulkDeleteButton();
            });
        });
    }

    bulkDeleteBtn.addEventListener('click', function() {
        if (_bulkDeleteTargetIds.length === 0) return;

        const count = _bulkDeleteTargetIds.length;
        const confirmMsg = count === 1
            ? 'Delete this inquiry? It cannot be recovered.'
            : `Delete ${count} inquiries? They cannot be recovered.`;

        if (confirm(confirmMsg)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.inquiries.bulk-delete") }}';

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_token';
                input.value = csrfToken.getAttribute('content');
                form.appendChild(input);
            }

            _bulkDeleteTargetIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    });

</script>
@endsection