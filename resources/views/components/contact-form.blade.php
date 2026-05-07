@props(['showHeading' => true])

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Outfit:wght@300;400;500;600&display=swap');

    .cf-container {
        font-family: 'Outfit', sans-serif;
        color: #f0ece4;
        margin-top: -48px;
    }

    .cf-heading {
        font-family: 'Cormorant Garamond', serif;
        font-size: 48px;
        font-weight: 300;
        line-height: 1.1;
        letter-spacing: -1px;
        color: #f0ece4;
        margin-bottom: 8px;
    }

    .cf-heading em {
        font-style: italic;
        color: #c8a96e;
    }

    .cf-subheading {
        font-size: 14px;
        color: rgba(240,236,228,.6);
        letter-spacing: 0.5px;
        margin-bottom: 32px;
    }

    /* Success Banner */
    .cf-success {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: rgba(74, 222, 128, .08);
        border: 1px solid rgba(74, 222, 128, .3);
        border-radius: 14px;
        color: #4ade80;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 24px;
        animation: slideIn 0.4s ease;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Grid */
    .cf-form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .cf-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 640px) {
        .cf-row {
            grid-template-columns: 1fr;
        }
    }

    /* Field */
    .cf-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .cf-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #c8a96e;
    }

    .cf-label-opt {
        font-size: 11px;
        font-weight: 400;
        letter-spacing: 0.8px;
        color: rgba(240,236,228,.4);
        text-transform: none;
    }

    /* Input & Textarea */
    .cf-input,
    .cf-textarea {
        width: 100%;
        padding: 14px 16px;
        background: #111316;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 12px;
        color: #f0ece4;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        outline: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-sizing: border-box;
    }

    .cf-input::placeholder,
    .cf-textarea::placeholder {
        color: rgba(240,236,228,.3);
    }

    .cf-input:focus,
    .cf-textarea:focus {
        background: #161820;
        border-color: rgba(200,169,110,.4);
        box-shadow: 0 0 0 3px rgba(200,169,110,.08), 0 0 20px rgba(200,169,110,.06);
    }

    .cf-input.cf-error,
    .cf-textarea.cf-error {
        border-color: rgba(239, 68, 68, .5);
        background: rgba(239, 68, 68, .03);
    }

    .cf-textarea {
        resize: none;
        min-height: 150px;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Error Message */
    .cf-error-msg {
        font-size: 12px;
        color: #ef4444;
        letter-spacing: 0.3px;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .cf-error-msg::before {
        content: '⚠';
        font-size: 11px;
    }

    /* Submit Button */
    .cf-submit {
        width: 100%;
        padding: 16px 28px;
        background: transparent;
        border: 1.5px solid rgba(200,169,110,.5);
        border-radius: 12px;
        color: #e8c98a;
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        margin-top: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .cf-submit::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(200,169,110,.15), rgba(200,169,110,.05));
        opacity: 0;
        transition: opacity 0.25s;
    }

    .cf-submit:hover {
        border-color: #e8c98a;
        box-shadow: 0 0 32px rgba(200,169,110,.18), inset 0 0 20px rgba(200,169,110,.04);
        transform: translateY(-2px);
    }

    .cf-submit:hover::before {
        opacity: 1;
    }

    .cf-submit:active {
        transform: translateY(0);
    }

    .cf-submit span {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Footer Note */
    .cf-note {
        font-size: 12px;
        color: rgba(240,236,228,.35);
        text-align: center;
        letter-spacing: 0.4px;
        margin-top: 16px;
        line-height: 1.6;
    }

    .cf-note i {
        color: #c8a96e;
        opacity: 0.6;
    }

    /* Divider Line */
    .cf-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(200,169,110,.2), transparent);
        margin-bottom: 16px;
    }
</style>

<div class="cf-container">
    @if($showHeading)
    <div class="cf-divider"></div>
    <h2 class="cf-heading">Send Me a <em>Message.</em></h2>
    <p class="cf-subheading">I'd love to hear from you. Get in touch and let's discuss your project.</p>
    @endif

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
                <label class="cf-label">Your Name <span style="color: rgba(200,169,110,.6);">*</span></label>
                <input type="text" name="name" required
                       class="cf-input @error('name') cf-error @enderror"
                       value="{{ old('name') }}"
                       placeholder="John Doe">
                @error('name')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="cf-field">
                <label class="cf-label">Your Email <span style="color: rgba(200,169,110,.6);">*</span></label>
                <input type="email" name="email" required
                       class="cf-input @error('email') cf-error @enderror"
                       value="{{ old('email') }}"
                       placeholder="john@example.com">
                @error('email')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Phone & Subject Row --}}
        <div class="cf-row">
            {{-- Phone --}}
            <div class="cf-field">
                <label class="cf-label">Phone <span class="cf-label-opt">(Optional)</span></label>
                <input type="tel" name="phone"
                       class="cf-input"
                       value="{{ old('phone') }}"
                       placeholder="+1 (555) 123-4567">
                @error('phone')
                <span class="cf-error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Subject --}}
            <div class="cf-field">
                <label class="cf-label">Subject <span class="cf-label-opt">(Optional)</span></label>
                <input type="text" name="subject"
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
            <label class="cf-label">Message <span style="color: rgba(200,169,110,.6);">*</span></label>
            <textarea name="message" required
                      class="cf-textarea @error('message') cf-error @enderror"
                      placeholder="Tell me about your project...">{{ old('message') }}</textarea>
            @error('message')
            <span class="cf-error-msg">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="cf-submit">
            <span>
                <i class="fas fa-arrow-right"></i>Send Message
            </span>
        </button>

        <p class="cf-note">
            <i class="fas fa-hourglass-end"></i> I'll respond within 24 hours
        </p>
    </form>
</div>