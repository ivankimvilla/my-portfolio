const passwordInput = document.getElementById('password');
const toggleButton = document.querySelector('.admin-password-toggle');

if (passwordInput && toggleButton) {
    toggleButton.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        toggleButton.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        toggleButton.setAttribute('title', isHidden ? 'Hide password' : 'Show password');
    });
}
