@props(['showHeading' => true])


<link rel="stylesheet" href="{{ asset('css/components/testimonial-form.css') }}">

<div class="tst-wrap">

    {{-- ── Heading ── --}}
    @if($showHeading)
        <div class="tst-heading">
            <div class="tst-eyebrow">Testimonials</div>
            <h3 class="tst-title">Share Your <em>Experience.</em></h3>
            <p class="tst-desc">Your feedback helps showcase the quality of our work.</p>
        </div>

        <div class="tst-divider">
            <div class="tst-divider-line"></div>
            <div class="tst-divider-dot"></div>
            <div class="tst-divider-line"></div>
        </div>
    @endif

    {{-- ── Alerts ── --}}
    @if($errors->any())
        <div class="tst-alert tst-alert-error">

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="tst-error-message" class="tst-alert tst-alert-error" style="display: none;">
        <!-- AJAX validation errors will be displayed here -->
    </div>

    <div id="tst-success-message" class="tst-alert tst-alert-success" style="display: none;">
       ✓ Thank you! Your testimonial has been successfully submitted and will be published shortly.
    </div>

    {{-- ── Form ── --}}
    <form id="testimonial-form" action="{{ route('testimonials.submit') }}" method="POST" class="tst-form">
        @csrf

        <div class="tst-form-row">
            <div class="tst-form-group">
                <label for="client_name" class="tst-form-label">Your Name *</label>
                <input id="client_name" type="text" name="client_name" class="tst-form-input"
                       value="{{ old('client_name') }}" required placeholder="Name">
            </div>

            <div class="tst-form-group">
                <label for="client_company" class="tst-form-label">Company <span style="opacity:.5;font-weight:400;">(Optional)</span></label>
                <input id="client_company" type="text" name="client_company" class="tst-form-input"
                       value="{{ old('client_company') }}" placeholder="Inc.">
            </div>
        </div>

        <div class="tst-form-row">
            <div class="tst-form-group">
                <label for="client_title" class="tst-form-label">Job Title <span style="opacity:.5;font-weight:400;">(Optional)</span></label>
                <input id="client_title" type="text" name="client_title" class="tst-form-input"
                       value="{{ old('client_title') }}" placeholder="CEO, Designer, etc.">
            </div>

            <div class="tst-form-group">
                <label for="project_url" class="tst-form-label">Project URL <span style="opacity:.5;font-weight:400;">(Optional)</span></label>
                <input id="project_url" type="url" name="project_url" class="tst-form-input"
                       value="{{ old('project_url') }}" placeholder="https://example.com">
            </div>
        </div>

        <div class="tst-form-group">
            <label for="content" class="tst-form-label">Your Feedback *</label>
            <textarea id="content" name="content" class="tst-form-textarea" required
                      placeholder="Share what it was like working together…">{{ old('content') }}</textarea>
        </div>

        <div class="tst-form-group">
            <label for="rating" class="tst-form-label">Rating *</label>
            <select id="rating" name="rating" class="tst-form-select" required>
                <option value="" disabled {{ old('rating') ? '' : 'selected' }} hidden>Select a rating…</option>
                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>★★★★★ — Excellent</option>
                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>★★★★☆ — Very Good</option>
                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>★★★☆☆ — Good</option>
                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>★★☆☆☆ — Fair</option>
                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>★☆☆☆☆ — Poor</option>
            </select>
        </div>

        <div class="tst-form-consent">
            <input type="checkbox" id="tst-consent" name="consent" value="1" required>
            <label for="tst-consent">
                I consent to my testimonial being published on this website.
            </label>
        </div>

        <button type="submit" class="tst-form-btn">
            <span><i class="fas fa-arrow-right" style="margin-right:7px;"></i>Submit Testimonial</span>
        </button>

    </form>

    <script>
        document.getElementById('testimonial-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.tst-form-btn');
            const originalText = submitBtn.innerHTML;

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span><i class="fas fa-spinner fa-spin" style="margin-right:7px;"></i>Submitting...</span>';

            // Clear previous messages
            document.querySelectorAll('.tst-alert').forEach(alert => alert.style.display = 'none');

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    // If response is not ok (like 422 validation error), parse as JSON
                    return response.json().then(data => {
                        throw new Error(JSON.stringify(data));
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message
                    const successMsg = document.getElementById('tst-success-message');
                    successMsg.style.display = 'block';

                    // Reset form
                    form.reset();

                    // Scroll to success message
                    successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    // Handle errors if any
                    console.error('Submission failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                try {
                    const errorData = JSON.parse(error.message);
                    if (errorData.errors) {
                        // Display validation errors
                        let errorHtml = '<ul>';
                        for (const field in errorData.errors) {
                            errorData.errors[field].forEach(errorMsg => {
                                errorHtml += `<li>${errorMsg}</li>`;
                            });
                        }
                        errorHtml += '</ul>';
                        
                        // Show error message
                        const errorMsg = document.getElementById('tst-error-message');
                        if (errorMsg) {
                            errorMsg.innerHTML = errorHtml;
                            errorMsg.style.display = 'block';
                            errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                } catch (e) {
                    // If not JSON error, fallback to regular form submission
                    form.submit();
                }
            })
            .finally(() => {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    </script>
</div>