@extends('layouts.admin')



@section('header', 'Edit Certificate')


<link rel="stylesheet" href="{{ asset('css/admin/certificates/edit.css') }}">


@section('content')


<div class="cert-form-wrap">

    <div class="cert-eyebrow">Edit</div>

    <h1 class="cert-card-title">Update <em>Certificate</em></h1>



    @if($errors->any())

    <div class="cert-alert cert-alert-error">

        <strong>Please fix the following errors:</strong>

        <ul>

            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif



    <div class="cert-card">

        <form method="POST" action="{{ route('admin.certificates.update', $certificate) }}" class="cert-form" enctype="multipart/form-data">

            @csrf

            @method('PUT')



            <div class="cert-form-group">

                <label for="title" class="cert-label">Certificate Title</label>

                <input type="text" id="title" name="title" value="{{ old('title', $certificate->title) }}" class="cert-input" placeholder="e.g., AWS Certified Solutions Architect" required>

                <div class="cert-hint">The name of the certificate</div>

            </div>



            <div class="cert-form-group">

                <label for="issuer" class="cert-label">Issuing Organization</label>

                <input type="text" id="issuer" name="issuer" value="{{ old('issuer', $certificate->issuer) }}" class="cert-input" placeholder="e.g., Amazon Web Services" required>

                <div class="cert-hint">The organization that issued the certificate</div>

            </div>



            <div class="cert-form-group">

                <label for="issue_date" class="cert-label">Issue Date</label>

                <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date', $certificate->issue_date->format('Y-m-d')) }}" class="cert-input" required>

                <div class="cert-hint">When was this certificate issued?</div>

            </div>



            <div class="cert-form-group">

                <label for="description" class="cert-label">Description (Optional)</label>

                <textarea id="description" name="description" class="cert-input cert-textarea" placeholder="Brief description of the certificate...">{{ old('description', $certificate->description) }}</textarea>

                <div class="cert-hint">Optional details about the certificate</div>

            </div>



            <div class="cert-form-group">

                <label for="certificate_file" class="cert-label">Certificate Image (Optional)</label>

                <input type="file" id="certificate_file" name="certificate_file" accept="image/*" class="cert-input">

                @if($certificate->certificate_path)

                <div class="cert-hint">Current image: <strong>{{ basename($certificate->certificate_path) }}</strong></div>

                @endif

                <div class="cert-hint">Upload a new certificate image to replace the current one (JPEG, PNG, WebP; max 5MB)</div>

            </div>



            <div class="cert-form-group">

                <div class="cert-checkbox-wrap">

                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $certificate->is_active) ? 'checked' : '' }} class="cert-checkbox">

                    <label for="is_active" class="cert-checkbox-label">Display this certificate on the website</label>

                </div>

            </div>



            <div class="cert-btns">

                <a href="{{ route('admin.certificates.index') }}" class="cert-btn cert-btn-secondary">

                    <i class="fas fa-arrow-left"></i> Cancel

                </a>

                <button type="submit" class="cert-btn cert-btn-primary">

                    <i class="fas fa-save"></i> Update Certificate

                </button>

            </form>

                <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}" style="display:inline; margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cert-btn cert-btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>

            </div>

    </div>

</div>

@endsection