document.querySelectorAll("[data-password-target]").forEach((toggle) => {
    const input = document.getElementById(toggle.dataset.passwordTarget);
    if (!input) return;

    toggle.addEventListener("click", () => {
        const showPassword = input.type === "password";
        input.type = showPassword ? "text" : "password";

        const label = toggle.getAttribute("aria-label").replace(/^(Show|Hide)/, showPassword ? "Hide" : "Show");
        toggle.setAttribute("aria-label", label);
        toggle.setAttribute("title", label);
    });
});