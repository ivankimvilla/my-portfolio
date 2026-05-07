@extends('layouts.admin')

@section('header', 'View Inquiry')

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
        --status-read-bg:       rgba(251,191,36,.10);
        --status-read-border:   rgba(251,191,36,.25);
        --status-read-color:    #fde68a;
        --status-resp-bg:       rgba(34,197,94,.10);
        --status-resp-border:   rgba(34,197,94,.25);
        --status-resp-color:    #86efac;
    }

    .inq-show { font-family: 'Outfit', sans-serif; max-width: 860px; margin: 0 auto; }

    /* ── BACK LINK ── */
    .inq-back {
        display: inline-flex; align-items: center; gap: 8px;
        color: var(--accent); text-decoration: none;
        font-size: 12px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1.5px;
        margin-bottom: 28px;
        opacity: .75;
        transition: opacity .2s, gap .2s;
    }
    .inq-back:hover { opacity: 1; gap: 12px; }
    .inq-back::before {
        content: '←';
        font-size: 14px;
    }

    /* ── MAIN CARD ── */
    .inq-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 40px rgba(0,0,0,.40);
    }

    /* Top accent rule */
    .inq-card::before {
        content: '';
        position: absolute; top: 0; left: 8%; right: 8%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: .22; z-index: 1;
    }

    /* ── CARD HEADER ── */
    .inq-card-header {
        padding: 36px 40px 28px;
        border-bottom: 1px solid var(--border);
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 24px;
    }

    .inq-card-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--accent); margin-bottom: 8px;
    }
    .inq-card-eyebrow::before {
        content: ''; display: block;
        width: 18px; height: 1px;
        background: var(--accent); opacity: .7;
    }

    .inq-card-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 30px; font-weight: 300;
        letter-spacing: -0.3px; color: var(--text);
        line-height: 1.15;
    }
    .inq-card-name em { font-style: italic; color: var(--accent); }

    .inq-card-received {
        font-size: 12px; color: var(--muted2);
        margin-top: 6px;
    }

    /* ── BADGE ── */
    .inq-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 14px;
        border-radius: 99px;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.8px;
        white-space: nowrap;
        flex-shrink: 0;
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
    .inq-badge-new::before { background: #60a5fa; }
    .inq-badge-read {
        background: var(--status-read-bg);
        border: 1px solid var(--status-read-border);
        color: var(--status-read-color);
    }
    .inq-badge-read::before { background: #fbbf24; }
    .inq-badge-responded {
        background: var(--status-resp-bg);
        border: 1px solid var(--status-resp-border);
        color: var(--status-resp-color);
    }
    .inq-badge-responded::before { background: #4ade80; }

    /* ── BODY ── */
    .inq-card-body { padding: 36px 40px; }

    /* Meta grid */
    .inq-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 28px;
        margin-bottom: 32px;
    }

    .inq-meta-label {
        font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 2px;
        color: var(--accent); margin-bottom: 8px;
    }

    .inq-meta-value {
        font-size: 15px; color: var(--text);
    }
    .inq-meta-value a {
        color: var(--accent2);
        text-decoration: none;
        transition: color .2s;
    }
    .inq-meta-value a:hover { color: var(--text); }

    /* Subject */
    .inq-subject-wrap { margin-bottom: 32px; }

    /* Message */
    .inq-msg-wrap { margin-bottom: 0; }

    .inq-msg-box {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 28px 32px;
        position: relative;
        overflow: hidden;
    }
    .inq-msg-box::before {
        content: '';
        position: absolute; left: 0; top: 12%; bottom: 12%; width: 2px;
        background: linear-gradient(180deg, transparent, var(--accent), transparent);
        opacity: .35;
    }

    .inq-msg-text {
        font-size: 15px;
        line-height: 1.8;
        color: rgba(240,236,228,.85);
        white-space: pre-wrap;
    }

    /* ── DIVIDER ── */
    .inq-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 0;
    }

    /* ── ACTIONS FOOTER ── */
    .inq-card-footer {
        padding: 24px 40px;
        display: flex; gap: 12px; flex-wrap: wrap;
        align-items: center;
    }

    /* Shared button base */
    .inq-footer-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 22px;
        border-radius: 10px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer; text-decoration: none;
        position: relative; overflow: hidden;
        transition: transform .15s, box-shadow .2s, border-color .2s, background .2s;
        border: 1px solid transparent;
    }
    .inq-footer-btn:hover { transform: translateY(-2px); }

    /* Respond — gold */
    .inq-btn-respond {
        background: rgba(200,169,110,.12);
        border-color: rgba(200,169,110,.35);
        color: var(--accent2);
    }
    .inq-btn-respond:hover {
        background: rgba(200,169,110,.2);
        border-color: rgba(200,169,110,.6);
        box-shadow: 0 4px 18px rgba(200,169,110,.15);
    }

    /* Reply — blue */
    .inq-btn-reply {
        background: rgba(96,165,250,.1);
        border-color: rgba(96,165,250,.28);
        color: #93c5fd;
    }
    .inq-btn-reply:hover {
        background: rgba(96,165,250,.18);
        border-color: rgba(96,165,250,.5);
        box-shadow: 0 4px 18px rgba(96,165,250,.12);
    }

    /* Delete — red */
    .inq-btn-delete {
        background: rgba(239,68,68,.08);
        border-color: rgba(239,68,68,.22);
        color: #fca5a5;
        margin-left: auto;
    }
    .inq-btn-delete:hover {
        background: rgba(239,68,68,.15);
        border-color: rgba(239,68,68,.45);
        box-shadow: 0 4px 18px rgba(239,68,68,.1);
    }
</style>

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
                <a href="https://mail.google.com/mail/u/0/#inbox?compose=new&to={{ urlencode($inquiry->email) }}&subject=Re: {{ urlencode($inquiry->subject ?? 'Message from ' . $inquiry->name) }}"
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