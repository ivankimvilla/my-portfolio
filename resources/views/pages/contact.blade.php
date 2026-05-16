@extends('layouts.app')

@section('title', 'Contact Me - Ivan Kim Almadin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pages/contact.css') }}">

<div class="contact-page">
    <div class="contact-container">
        <div class="contact-content">
            <x-contact-form />
        </div>
    </div>
</div>

@endsection
