@extends('layouts.app')

@section('title', 'Contact Me - Ivan Kim Almadin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pages/contact.css') }}">

<div class="contact-page">
    <div class="contact-shell">
        <section class="contact-info-panel">
            <h1>Get in touch</h1>
            <p>Tell me what you're building and when you need it. I reply within two working days.</p>

            <div class="contact-email-box">
                <span>almadinivan12@gmail.com</span>
                <button type="button" class="copy-email" data-copy="almadinivan12@gmail.com">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 3H7.5A2.5 2.5 0 0 0 5 5.5v10A2.5 2.5 0 0 0 7.5 18H15a2.5 2.5 0 0 0 2.5-2.5v-10A2.5 2.5 0 0 0 15 3Zm.5 12.5a.5.5 0 0 1-.5.5H7.5a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5H15a.5.5 0 0 1 .5.5v10Zm2.5-3.5v7.5a2.5 2.5 0 0 1-2.5 2.5H8.5a.5.5 0 0 1 0-1H15a1.5 1.5 0 0 0 1.5-1.5V12.5a.5.5 0 0 1 1 0Z"/></svg>
                    Copy email
                </button>
            </div>

            <div class="contact-phone-box">
                <span>Mobile: 09535786765</span>
            </div>

            <ul class="contact-links">
                <li>
                    <span>GitHub</span>
                    <a href="https://github.com/ivankimvilla" target="_blank" rel="noopener">Ivan Kim Almadin</a>
                    <svg class="link-arrow" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8"/></svg>
                </li>
                <li>
                    <span>LinkedIn</span>
                    <a href="https://www.linkedin.com/in/ivan-kim-almadin-483b16408" target="_blank" rel="noopener">Ivan Kim Almadin</a>
                    <svg class="link-arrow" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8"/></svg>
                </li>
            </ul>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyButton = document.querySelector('.copy-email');
        if (copyButton) {
            copyButton.addEventListener('click', async function () {
                const value = copyButton.dataset.copy || '';
                try {
                    await navigator.clipboard.writeText(value);
                    const original = copyButton.innerHTML;
                    copyButton.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5 9 16.5 19 6.5"/></svg> Copied';
                    setTimeout(() => {
                        copyButton.innerHTML = original;
                    }, 1200);
                } catch (error) {
                    console.log('Copy failed:', error);
                }
            });
        }

        const form = document.getElementById('contactForm');
        const composeButton = document.getElementById('composeEmailBtn');

        if (form && composeButton) {
            composeButton.addEventListener('click', function () {
                const name = form.querySelector('[name="name"]').value.trim();
                const email = form.querySelector('[name="email"]').value.trim();
                const message = form.querySelector('[name="message"]').value.trim();

                if (!name || !email || !message) {
                    form.reportValidity();
                    return;
                }

                const subject = encodeURIComponent(`Project inquiry from ${name}`);
                const body = encodeURIComponent(
                    `Name: ${name}\nEmail: ${email}\n\nProject description:\n${message}`
                );

                window.location.href = `mailto:almadinivan12@gmail.com?subject=${subject}&body=${body}`;
            });
        }
    });
</script>

@endsection
