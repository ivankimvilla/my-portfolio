document.addEventListener("DOMContentLoaded", () => {
    const nav = document.querySelector(".site-nav");
    const toggle = document.querySelector(".nav-toggle");
    toggle?.addEventListener("click", () => {
        const open = nav.classList.toggle("menu-open");
        toggle.setAttribute("aria-expanded", String(open));
    });

    const targets = document.querySelectorAll(".about-redesign .about-reveal");
    targets.forEach((target) => target.classList.add("motion-in"));
    const observer = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
    }), { threshold: 0.08 });
    targets.forEach((target) => observer.observe(target));
});
