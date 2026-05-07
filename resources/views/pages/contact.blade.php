@extends('layouts.app')

@section('title', 'Contact Me - Ivan Kim Almadin')

@section('content')
<style>
    .contact-page {
        padding: 100px 0;
        background: #0b0c0e;
        color: #f0ece4;
        min-height: calc(100vh - 140px);
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 48px;
    }

    @media (max-width: 768px) {
        .contact-container { padding: 0 24px; }
        .contact-page { padding: 60px 0; }
    }

    .contact-content {
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<div class="contact-page">
    <div class="contact-container">
        <div class="contact-content">
            <x-contact-form />
        </div>
    </div>
</div>

@endsection
