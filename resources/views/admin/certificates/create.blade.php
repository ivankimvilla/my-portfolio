@extends('layouts.admin')



@section('header', 'Add New Certificate')


<link rel="stylesheet" href="{{ asset('css/admin/certificates/create.css') }}">


@section('content')


<div class="cert-form-wrap">

    <div class="cert-eyebrow">Create</div>

    <h1 class="cert-card-title">Add New <em>Certificate</em></h1>



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

        <form method="POST" action="{{ route('admin.certificates.store') }}" class="cert-form" enctype="multipart/form-data">

            @csrf



            <div class="cert-form-group">

                <label for="title" class="cert-label">Certificate Title</label>

                <input type="text" id="title" name="title" value="{{ old('title') }}" class="cert-input" placeholder="e.g., AWS Certified Solutions Architect" required>

                <div class="cert-hint">The name of the certificate</div>

            </div>



            <div class="cert-form-group">

                <label for="issuer" class="cert-label">Issuing Organization</label>

                <input type="text" id="issuer" name="issuer" value="{{ old('issuer') }}" class="cert-input" placeholder="e.g., Amazon Web Services" required>

                <div class="cert-hint">The organization that issued the certificate</div>

            </div>



            <div class="cert-form-group">

                <label for="issue_date" class="cert-label">Issue Date</label>

                <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" class="cert-input" required>

                <div class="cert-hint">When was this certificate issued?</div>

            </div>



            <div class="cert-form-group">

                <label for="description" class="cert-label">Description (Optional)</label>

                <textarea id="description" name="description" class="cert-input cert-textarea" placeholder="Brief description of the certificate...">{{ old('description') }}</textarea>

                <div class="cert-hint">Optional details about the certificate</div>

            </div>



            <div class="cert-form-group">

                <label for="certificate_file" class="cert-label">Certificate Image (Optional)</label>

                <input type="file" id="certificate_file" name="certificate_file" accept="image/*" class="cert-input">

                <div class="cert-hint">Upload the certificate image file (JPEG, PNG, WebP; max 5MB)</div>

            </div>



            <div class="cert-form-group">

                <div class="cert-checkbox-wrap">


                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="cert-checkbox">

                    <label for="is_active" class="cert-checkbox-label">Display this certificate on the website</label>

                </div>

            </div>



            <div class="cert-btns">

                <a href="{{ route('admin.certificates.index') }}" class="cert-btn cert-btn-secondary">

                    <i class="fas fa-arrow-left"></i> Cancel

                </a>

                <button type="submit" class="cert-btn cert-btn-primary">

                    <i class="fas fa-save"></i> Create Certificate

                </button>

            </div>

        </form>

    </div>

</div>

@endsection