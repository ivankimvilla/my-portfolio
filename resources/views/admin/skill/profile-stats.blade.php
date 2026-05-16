@extends('layouts.admin')
@section('title', 'Admin Stats')
@section('header', 'Admin Stats Settings')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/skill/profile-stats.css') }}">

<section class="ab-stats" style="padding: 0; margin: 0; background: none;">
    <div>
        <div style="display:flex; align-items:center; gap:10px; font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:2.5px; color:#c8a96e; margin-bottom:10px;">
            <span style="display:inline-block; width:20px; height:1px; background:#c8a96e; flex-shrink:0;"></span>
            Management
        </div>
        <h2 style="font-family:'Cormorant Garamond',serif; font-size:32px; font-weight:300; letter-spacing:-0.5px; color:#f0ece4; margin:0 0 4px;">
            Update <em style="font-style:italic; color:#c8a96e;">Stats.</em>
        </h2>
    </div>

    <div class="ab-divider" style="margin-top:16px;">
        <div class="ab-divider-line"></div>
        <div class="ab-divider-dot"></div>
        <div class="ab-divider-line"></div>
    </div>

    @if ($errors->any())
        <div class="pf-alert pf-alert-error" style="margin-bottom: 24px;">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="pf-alert pf-alert-success" style="margin-bottom: 24px;">
            {{ session('success') }}
        </div>
    @endif


    <form method="POST" action="{{ route('admin.profile.stats.update') }}" style="margin-top: 32px;">
        @csrf
        @method('PUT')

        @php
            $statIcons = ['fas fa-chart-line', 'fas fa-trophy', 'fas fa-handshake'];
        @endphp

        <div class="ab-stats-grid">
            @for ($i = 1; $i <= 3; $i++)
                <div class="ab-stat-card">
                    <div class="ab-stat-icon"><i class="{{ $statIcons[$i - 1] }}"></i></div>
                    <input
                        type="text"
                        name="stat_{{ $i }}_number"
                        id="stat_{{ $i }}_number"
                        value="{{ old('stat_' . $i . '_number', data_get($user, 'stats.' . ($i - 1) . '.number')) }}"
                        class="ab-stat-number"
                        placeholder="5+"
                        style="border: none; background: transparent; outline: none; text-align: center; width: 100%;"
                    />
                    <input
                        type="text"
                        name="stat_{{ $i }}_label"
                        id="stat_{{ $i }}_label"
                        value="{{ old('stat_' . $i . '_label', data_get($user, 'stats.' . ($i - 1) . '.label')) }}"
                        class="ab-stat-label"
                        placeholder="Years Experience"
                        style="border: none; background: transparent; outline: none; text-align: center; width: 100%;"
                    />
                    <input
                        type="text"
                        name="stat_{{ $i }}_desc"
                        id="stat_{{ $i }}_desc"
                        value="{{ old('stat_' . $i . '_desc', data_get($user, 'stats.' . ($i - 1) . '.desc')) }}"
                        class="ab-stat-desc"
                        placeholder="Building professional web solutions across industries."
                        style="border: none; background: transparent; outline: none; text-align: center; width: 100%;"
                    />
                </div>
            @endfor
        </div>

        <button type="submit" class="pf-btn-primary" style="margin-top: 32px;">
            <span><i class="fas fa-save" style="margin-right:6px;"></i>Save Changes</span>
        </button>
    </form>
</section>
@endsection