@extends('layouts.admin')

@section('header', 'View Inquiry')
<link rel="stylesheet" href="{{ asset('css/admin/inquiries/show.css') }}">
@section('content')

<div class="inq-show">

    <a href="{{ route('admin.inquiries.index') }}" class="inq-back">Back to Inquiries</a>

    <div class="inq-card">

        {{-- Card Header --}}
        <div class="inq-card-header">
            <div>
                <div class="inq-card-eyebrow">Inquiry</div>
                <div class="inq-card-name">{{ $inquiry->name }}</div>
                <div class="inq-card-received">Received {{ $inquiry->created_at->format('M d, Y \a\t H:i') }}</div>
            </div>
            @php
                $badgeClass = match($inquiry->status) {
                    'responded' => 'inq-badge-responded',
                    'read'      => 'inq-badge-read',
                    default     => 'inq-badge-new',
                };
            @endphp
            <span class="inq-badge {{ $badgeClass }}">{{ ucfirst($inquiry->status) }}</span>
        </div>

        {{-- Card Body --}}
        <div class="inq-card-body">

            {{-- Meta grid --}}
            <div class="inq-meta-grid">
                <div>
                    <div class="inq-meta-label">Email</div>
                    <div class="inq-meta-value">
                        <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                    </div>
                </div>
                @if($inquiry->phone)
                <div>
                    <div class="inq-meta-label">Phone</div>
                    <div class="inq-meta-value">
                        <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                    </div>
                </div>
                @endif
            </div>

            {{-- Subject --}}
            @if($inquiry->subject)
            <div class="inq-subject-wrap">
                <div class="inq-meta-label">Subject</div>
                <div class="inq-meta-value" style="font-size:16px; margin-top:8px;">{{ $inquiry->subject }}</div>
            </div>
            @endif

            {{-- Message --}}
            <div class="inq-msg-wrap">
                <div class="inq-meta-label" style="margin-bottom:12px;">Message</div>
                <div class="inq-msg-box">
                    <p class="inq-msg-text">{{ $inquiry->message }}</p>
                </div>
            </div>

        </div>

        <hr class="inq-divider">

        {{-- Footer Actions --}}
        <div class="inq-card-footer">
            {{-- Responded Indicator --}}
            @if($inquiry->status === 'responded')
            <div class="inq-responded-banner">
                <i class="fas fa-check-double"></i>
                <div class="inq-responded-text">
                    <span class="inq-responded-label">✓ Response Sent</span>
                    <span class="inq-responded-time">on {{ $inquiry->responded_at->format('M d, Y \a\t H:i') }}</span>
                </div>
            </div>
            @endif

            @if($inquiry->status !== 'responded')
            <form method="POST" action="{{ route('admin.inquiries.mark-responded', $inquiry) }}" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="inq-footer-btn inq-btn-respond">
                    <i class="fas fa-check"></i> Mark as Responded
                </button>
            </form>
            @endif

            @if(auth()->check() && auth()->user()->email === 'ivanalmadin0@gmail.com')
                <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to={{ urlencode($inquiry->email) }}&su={{ urlencode('Re: ' . ($inquiry->subject ?? 'Message from ' . $inquiry->name)) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inq-footer-btn inq-btn-reply">
                    <i class="fas fa-reply"></i> Reply via Gmail
                </a>
            @else
                <button type="button" class="inq-footer-btn inq-btn-reply" disabled title="Only ivanalmadin0@gmail.com can reply" style="opacity: 0.5; cursor: not-allowed;">
                    <i class="fas fa-lock"></i> Unauthorized
                </button>
            @endif

            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" id="delete-form" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="inq-footer-btn inq-btn-delete" onclick="openDeleteModal()">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>

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
            <button class="del-btn del-btn-confirm" onclick="document.getElementById('delete-form').submit()">
                <i class="fas fa-trash" style="font-size:11px;"></i> Delete
            </button>
        </div>
    </div>
</div>

<style>
    /* ── BACKDROP ── */
    .del-backdrop {
        position: fixed; inset: 0;
        background: rgba(5,6,8,.82);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        z-index: 998;
        animation: delFadeIn .2s ease;
    }

    /* ── DIALOG ── */
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

    /* Top accent line */
    .del-dialog::before {
        content: '';
        position: absolute; top: 0; left: 15%; right: 15%; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(239,68,68,.5), transparent);
        border-radius: 1px;
    }

    /* ── ICON ── */
    .del-icon-wrap {
        display: flex; justify-content: center;
        margin-bottom: 22px;
    }
    .del-icon-ring {
        width: 60px; height: 60px;
        border-radius: 50%;
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.22);
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 28px rgba(239,68,68,.1);
    }
    .del-icon {
        font-size: 20px;
        color: #fca5a5;
    }

    /* ── TEXT ── */
    .del-heading {
        font-family: 'Cormorant Garamond', serif;
        font-size: 24px; font-weight: 400;
        color: #f0ece4;
        margin: 0 0 12px;
        letter-spacing: -0.2px;
    }
    .del-body {
        font-family: 'Outfit', sans-serif;
        font-size: 14px; line-height: 1.65;
        color: rgba(240,236,228,.45);
        margin: 0 0 28px;
    }

    /* ── BUTTONS ── */
    .del-actions {
        display: flex; gap: 10px;
    }
    .del-btn {
        flex: 1;
        padding: 11px 0;
        border-radius: 10px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer;
        border: 1px solid transparent;
        transition: background .2s, border-color .2s, transform .15s, box-shadow .2s;
    }
    .del-btn:hover { transform: translateY(-1px); }

    .del-btn-cancel {
        background: rgba(255,255,255,.04);
        border-color: rgba(255,255,255,.09);
        color: rgba(240,236,228,.6);
    }
    .del-btn-cancel:hover {
        background: rgba(255,255,255,.08);
        border-color: rgba(255,255,255,.15);
        color: rgba(240,236,228,.9);
    }

    .del-btn-confirm {
        background: rgba(239,68,68,.12);
        border-color: rgba(239,68,68,.3);
        color: #fca5a5;
        display: inline-flex; align-items: center;
        justify-content: center; gap: 7px;
    }
    .del-btn-confirm:hover {
        background: rgba(239,68,68,.2);
        border-color: rgba(239,68,68,.55);
        box-shadow: 0 4px 18px rgba(239,68,68,.15);
        color: #fecaca;
    }

    /* ── ANIMATIONS ── */
    @keyframes delFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    @keyframes delSlideUp {
        from { opacity: 0; transform: translate(-50%, calc(-50% + 16px)); }
        to   { opacity: 1; transform: translate(-50%, -50%); }
    }
</style>

<script>
    function openDeleteModal() {
        document.getElementById('delete-modal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('delete-modal').style.display = 'none';
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endsection