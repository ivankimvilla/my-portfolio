@extends('layouts.admin')

@section('title', 'Admin - Resume')
@section('header', 'Resume')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:0;">
</h2>

    @php
    use App\Models\Resume;
    $uploadDir = public_path('uploads');
    $resume = Resume::first();
    $filename = $resume?->filename;
    $original = $resume?->original_name;
    $hasResume = $filename && file_exists($uploadDir . DIRECTORY_SEPARATOR . $filename);
@endphp

<div style="display:flex;gap:24px;flex-wrap:wrap;align-items:flex-start;">
    <div style="flex:1;min-width:280px;">
        <div style="border:1px solid var(--border);border-radius:16px;padding:18px;background:rgba(255,255,255,0.02)">
            <div class="ab-eyebrow">Current</div>
            <div style="margin-bottom:8px;font-weight:700;color:var(--text);">Resume File</div>
                @if($hasResume)
                <div style="display:flex;gap:12px;align-items:center;">
                    <div style="flex:1;color:var(--muted);">{{ $original ?: $filename }}</div>
                    @php $ext = $resume?->mime_type ? strtolower(pathinfo($resume->filename, PATHINFO_EXTENSION)) : strtolower(pathinfo($filename, PATHINFO_EXTENSION)); @endphp
                    <a href="{{ asset('uploads/' . $filename) }}" id="resume-view-btn" data-filename="{{ $filename }}" data-ext="{{ $ext }}" class="ab-btn-primary" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:10px;padding:8px 12px;background:linear-gradient(90deg,#f5e6c0,#e8c98a);color:#0b0c0e;border-radius:10px;border:1px solid rgba(0,0,0,0.06);box-shadow:0 8px 20px rgba(0,0,0,0.12);">
                        <i class="fas fa-eye" style="color:inherit;font-size:14px"></i>
                        <span style="font-weight:700;">View</span>
                        <span style="background:rgba(0,0,0,0.06);padding:4px 8px;border-radius:8px;font-size:12px;color:rgba(0,0,0,0.6);">{{ strtoupper($ext) }}</span>
                    </a>

                    <div id="resume-preview-modal" style="display:none;position:fixed;inset:0;z-index:60;align-items:center;justify-content:center;background:rgba(2,6,23,0.6);">
                        <div style="max-width:90%;max-height:90%;width:920px;background:var(--surface);border-radius:12px;overflow:hidden;border:1px solid var(--border);box-shadow:0 40px 80px rgba(2,6,23,0.6);position:relative;">
                            <button id="resume-preview-close" style="position:absolute;top:12px;right:12px;z-index:70;background:rgba(0,0,0,0.6);color:white;border:0;padding:8px 10px;border-radius:8px;cursor:pointer;">Close</button>
                            <div id="resume-preview-body" style="width:100%;height:100%;min-height:480px;display:flex;align-items:center;justify-content:center;background:transparent;">
                                <!-- preview content injected here -->
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div style="color:var(--muted2)">No resume uploaded yet.</div>
            @endif
        </div>
    </div>

    <div style="min-width:320px;flex-shrink:0;">
        <div style="border:1px solid var(--border);border-radius:16px;padding:18px;background:rgba(255,255,255,0.02)">
            <div class="ab-eyebrow">Upload</div>
            <div style="margin-bottom:10px;font-weight:700;color:var(--text);">Upload New Resume</div>

            @if ($errors->any())
                <div class="admin-alert p-3" style="margin-bottom:12px;color:#ffcdd2;">
                    <ul style="margin:0;padding-left:16px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="admin-alert admin-alert-success p-3" style="margin-bottom:12px;color:#c8e6c9;">
                    {{ session('success') }}
                </div>
            @endif

            <div id="resume-error" class="admin-alert p-3" style="display:none;margin-bottom:12px;color:#ffd2d2;background:rgba(127,29,29,0.18);border-color:rgba(239,68,68,0.18);">Please select a file before uploading.</div>

            <form id="resume-upload-form" action="{{ route('admin.resume.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                    <input id="resume-file-input" type="file" name="resume" style="display:none;" />

                    <label for="resume-file-input" class="ab-btn-primary" style="display:inline-flex;align-items:center;gap:10px;cursor:pointer;padding:10px 14px;background:linear-gradient(90deg,#b9965d,#e8c98a);color:#0b0c0e;border-radius:10px;border:1px solid rgba(0,0,0,0.08);box-shadow:0 8px 20px rgba(0,0,0,0.25);">
                        <i class="fas fa-file-arrow-up" style="font-size:16px;color:inherit;"></i>
                        <span style="font-weight:700;color:inherit;">Select File</span>
                    </label>

                    <span id="resume-file-name" style="color:var(--muted);font-size:14px;min-width:160px;">No file selected</span>

                    <button id="resume-upload-btn" type="submit" class="ab-btn-primary" style="margin-left:auto;display:inline-flex;align-items:center;gap:8px;padding:10px 18px;background:transparent;border:1px solid rgba(200,169,110,.5);border-radius:10px;color:var(--accent2);font-weight:700;">
                        <i class="fas fa-cloud-upload-alt" style="font-size:14px;color:inherit"></i>
                        <span>Upload Resume</span>
                    </button>
                </div>
            </form>

            <script>
                (function(){
                    const input = document.getElementById('resume-file-input');
                    const nameEl = document.getElementById('resume-file-name');
                    const form = document.getElementById('resume-upload-form');
                    const err = document.getElementById('resume-error');

                    const viewBtn = document.getElementById('resume-view-btn');
                    const modal = document.getElementById('resume-preview-modal');
                    const modalBody = document.getElementById('resume-preview-body');
                    const modalClose = document.getElementById('resume-preview-close');

                    if (!input || !form) return;

                    input.addEventListener('change', function(){
                        const f = input.files && input.files[0];
                        nameEl.textContent = f ? f.name : 'No file selected';
                        if (err) err.style.display = 'none';
                    });

                    form.addEventListener('submit', function(e){
                        const f = input.files && input.files[0];
                        if (!f) {
                            e.preventDefault();
                            if (err) {
                                err.style.display = 'block';
                                err.textContent = 'Please select a file before uploading.';
                            }
                            // focus the select label
                            document.querySelector('label[for="resume-file-input"]').scrollIntoView({behavior:'smooth',block:'center'});
                            return false;
                        }
                        return true;
                    });

                    // Preview handler for admin View button
                    if (viewBtn && modal && modalBody && modalClose) {
                        viewBtn.addEventListener('click', function(ev){
                            // try to open modal for images and PDFs; otherwise fall back to normal link
                            const ext = (viewBtn.dataset.ext || '').toLowerCase();
                            const url = viewBtn.href;
                            if (['png','jpg','jpeg','gif','webp','svg','pdf'].includes(ext)) {
                                ev.preventDefault();
                                modal.style.display = 'flex';
                                // clear body
                                modalBody.innerHTML = '';
                                if (ext === 'pdf') {
                                    const iframe = document.createElement('iframe');
                                    iframe.src = url;
                                    iframe.style.width = '100%';
                                    iframe.style.height = '80vh';
                                    iframe.style.border = '0';
                                    modalBody.appendChild(iframe);
                                } else {
                                    const img = document.createElement('img');
                                    img.src = url;
                                    img.style.maxWidth = '100%';
                                    img.style.maxHeight = '80vh';
                                    img.style.objectFit = 'contain';
                                    modalBody.appendChild(img);
                                }
                            }
                        });

                        modalClose.addEventListener('click', function(){ modal.style.display = 'none'; modalBody.innerHTML = ''; });
                        modal.addEventListener('click', function(e){ if (e.target === modal) { modal.style.display = 'none'; modalBody.innerHTML = ''; } });
                    }
                })();
            </script>
        </div>
    </div>
</div>
</div>
@endsection
