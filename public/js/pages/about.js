function setupNavigation() {
    const nav = document.querySelector(".site-nav");
    const toggle = document.querySelector(".nav-toggle");
    if (!nav || !toggle) return;

    toggle.addEventListener("click", () => {
        const open = nav.classList.toggle("menu-open");
        toggle.setAttribute("aria-expanded", String(open));
        toggle.setAttribute("aria-label", open ? "Close navigation" : "Open navigation");
    });
}

function setupReveal() {
    const items = document.querySelectorAll(".reveal");

    if (!("IntersectionObserver" in window)) {
        items.forEach((item) => item.classList.add("is-visible"));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(({ target, isIntersecting, intersectionRatio }) => {
            if (isIntersecting && intersectionRatio >= 0.12) target.classList.add("is-visible");
            else if (!isIntersecting) target.classList.remove("is-visible");
        });
    }, { threshold: [0, 0.12], rootMargin: "0px 0px -6% 0px" });

    items.forEach((item) => {
        const position = [...item.parentElement.children].indexOf(item);
        item.style.setProperty("--d", `${Math.min(position, 8) * 70}ms`);
        observer.observe(item);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    setupNavigation();
    setupReveal();
});