@extends('layouts.admin')



@section('title', 'Admin Account')

@section('header', 'Admin Account Settings')

<link rel="stylesheet" href="{{ asset('css/admin/profile/profile.css') }}">

@section('content')


<div class="profile-wrap">



    <div class="pf-eyebrow">Account Settings</div>



    <div class="pf-card">

        <h3 class="pf-card-title">Update <em>Account</em></h3>



        {{-- Error Alert --}}

        @if ($errors->any())

            <div class="pf-alert pf-alert-error">

                <strong>Please fix the following:</strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        {{-- Success Alert --}}

        @if(session('success'))

            <div class="pf-alert pf-alert-success">

                {{ session('success') }}

            </div>

        @endif



        <form method="POST" action="{{ route('admin.profile.update') }}" class="pf-form">

            @csrf

            @method('PUT')



            <div class="pf-subcard">

                <h4 class="pf-subcard-title">Account Settings</h4>



                <div class="pf-form-group">

                    <label for="email" class="pf-label">Primary Email</label>

                    <div class="pf-input-wrap">

                        <input

                            type="email"

                            name="email"

                            id="email"

                            value="{{ old('email', $user->email) }}"

                            required

                            class="pf-input"

                        />

                    </div>

                </div>



                <div class="pf-form-group">

                    <label for="recovery_email" class="pf-label">Recovery Email</label>

                    <div class="pf-input-wrap">

                        <input

                            type="email"

                            name="recovery_email"

                            id="recovery_email"

                            value="{{ old('recovery_email', $user->recovery_email) }}"

                            class="pf-input"

                        />

                    </div>

                    <p class="pf-input-hint">This email is used for account recovery.</p>

                </div>

            </div>



            <div class="pf-subcard">

                <h4 class="pf-subcard-title">Change <em>Password</em></h4>



                <div class="pf-form-group">

                    <label for="current_password" class="pf-label">Current Password</label>

                    <div class="pf-input-wrap">

                        <input

                            type="password"

                            name="current_password"

                            id="current_password"

                            class="pf-input has-eye"

                            placeholder="Enter current password"

                        />

                        <button type="button" class="pf-eye-btn" onclick="togglePassword('current_password', this)" tabindex="-1">

                            <i class="fas fa-eye"></i>

                        </button>

                    </div>

                </div>



                <div class="pf-form-group">

                    <label for="password" class="pf-label">New Password</label>

                    <div class="pf-input-wrap">

                        <input

                            type="password"

                            name="password"

                            id="password"

                            class="pf-input has-eye"

                            placeholder="Leave blank to keep current password"

                        />

                        <button type="button" class="pf-eye-btn" onclick="togglePassword('password', this)" tabindex="-1">

                            <i class="fas fa-eye"></i>

                        </button>

                    </div>

                </div>



                <div class="pf-form-group" style="margin-bottom:0;">

                    <label for="password_confirmation" class="pf-label">Confirm New Password</label>

                    <div class="pf-input-wrap">

                        <input

                            type="password"

                            name="password_confirmation"

                            id="password_confirmation"

                            class="pf-input has-eye"

                            placeholder="Repeat new password"

                        />

                        <button type="button" class="pf-eye-btn" onclick="togglePassword('password_confirmation', this)" tabindex="-1">

                            <i class="fas fa-eye"></i>

                        </button>

                    </div>

                </div>

            </div>



            <button type="submit" class="pf-btn-primary">

                <span><i class="fas fa-save" style="margin-right:6px;"></i>Save Changes</span>

            </button>

        </form>

    </div>



</div>



<script>

    function togglePassword(fieldId, btn) {

        const input = document.getElementById(fieldId);

        const icon  = btn.querySelector('i');

        if (input.type === 'password') {

            input.type = 'text';

            icon.classList.replace('fa-eye', 'fa-eye-slash');

        } else {

            input.type = 'password';

            icon.classList.replace('fa-eye-slash', 'fa-eye');

        }

    }



    document.addEventListener('DOMContentLoaded', function () {

        // No tab logic on the original account page.

    });

</script>



@endsection