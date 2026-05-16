@props(['showHeading' => true])


<link rel="stylesheet" href="{{ asset('css/components/contact-form.css') }}">

<div class="cf-container">
    @if($showHeading)
    <div class="cf-divider"></div>
    <h2 class="cf-heading">Send Me a <em>Message.</em></h2>
    <p class="cf-subheading">I'd love to hear from you. Get in touch and let's discuss your project.</p>
    @endif

    <div id="successMessage" class="cf-success" style="display: none;">
        <i class="fas fa-check-circle"></i>
        <span id="successText"></span>
    </div>

    <div id="errorMessage" class="cf-error-banner">
        <div style="flex-shrink: 0; font-size: 18px;">⚠</div>
        <ul id="errorList" class="cf-error-list"></ul>
    </div>

    @if(session('success'))
    <div class="cf-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" class="cf-form" id="contactForm">
        @csrf

        {{-- Name & Email Row --}}
        <div class="cf-row">
            {{-- Name --}}
            <div class="cf-field">
                <label for="name" class="cf-label">Your Name <span style="color: rgba(200,169,110,.6);">*</span></label>
                <input type="text" id="name" name="name" required autocomplete="name"
                       class="cf-input @error('name') cf-error @enderror"
                       value="{{ old('name') }}"
                       placeholder="Name">
                @error('name')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="cf-field">
                <label for="email" class="cf-label">Your Email <span style="color: rgba(200,169,110,.6);">*</span></label>
                <input type="email" id="email" name="email" required autocomplete="email"
                       class="cf-input @error('email') cf-error @enderror"
                       value="{{ old('email') }}"
                       placeholder="you@example.com">
                @error('email')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Phone & Subject Row --}}
        <div class="cf-row">
            {{-- Phone --}}
            <div class="cf-field">
                <label for="phone" class="cf-label">Phone <span class="cf-label-opt">(Optional)</span></label>
                <input type="tel" id="phone" name="phone" autocomplete="tel"
                       class="cf-input"
                       value="{{ old('phone') }}"
                       placeholder="+1 (555) 123-4567">
                @error('phone')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Subject --}}
            <div class="cf-field">
                <label for="subject" class="cf-label">Subject <span class="cf-label-opt">(Optional)</span></label>
                <input type="text" id="subject" name="subject" autocomplete="off"
                       class="cf-input"
                       value="{{ old('subject') }}"
                       placeholder="What is this about?">
                @error('subject')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Message --}}
        <div class="cf-field">
            <label for="message" class="cf-label">Message <span style="color: rgba(200,169,110,.6);">*</span></label>
            <textarea id="message" name="message" required autocomplete="off"
                      class="cf-textarea @error('message') cf-error @enderror"
                      placeholder="Tell me about your project...">{{ old('message') }}</textarea>
            @error('message')
            <span class="cf-error-msg">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="cf-submit" id="submitBtn">
            <span>
                <i class="fas fa-arrow-right"></i>Send Message
            </span>
        </button>

        <p class="cf-note">
            <i class="fas fa-hourglass-end"></i> I'll respond within 24 hours
        </p>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        const errorList = document.getElementById('errorList');
        const successText = document.getElementById('successText');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Hide previous messages
            successMessage.style.display = 'none';
            errorMessage.classList.remove('show');
            errorList.innerHTML = '';

            // Clear error states
            form.querySelectorAll('.cf-error').forEach(el => el.classList.remove('cf-error'));
            form.querySelectorAll('.cf-error-msg').forEach(el => el.style.display = 'none');

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            submitBtn.querySelector('i').classList.remove('fa-arrow-right');
            submitBtn.querySelector('i').classList.add('fa-spinner');

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    // Success
                    successText.textContent = data.message;
                    successMessage.style.display = 'flex';

                    // Reset form
                    form.reset();

                    // Scroll to message
                    successMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    // Validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const errors = data.errors[field];
                            const input = form.querySelector(`[name="${field}"]`);

                            // Show field error
                            if (input) {
                                input.classList.add('cf-error');
                            }

                            // Add to error list
                            errors.forEach(error => {
                                const li = document.createElement('li');
                                li.textContent = error;
                                errorList.appendChild(li);
                            });
                        });

                        errorMessage.classList.add('show');
                        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                const li = document.createElement('li');
                li.textContent = 'An error occurred. Please try again later.';
                errorList.appendChild(li);
                errorMessage.classList.add('show');
                errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } finally {
                // Remove loading state
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
                submitBtn.querySelector('i').classList.add('fa-arrow-right');
                submitBtn.querySelector('i').classList.remove('fa-spinner');
            }
        });
    });
</script>