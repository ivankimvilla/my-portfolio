const ROLES = ["Full-Stack Development", "AI Integration", "AI Agent Pipelines", "Prompt Engineering"];
const ROLE_INTERVAL = 2800;
const ROLE_FADE = 300;

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
        item.style.setProperty("--d", `${Math.min(position, 8) * 60}ms`);
        observer.observe(item);
    });
}

function setupRoleRotator() {
    const role = document.querySelector("#role-text");
    if (!role || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    let index = 0;
    setInterval(() => {
        role.classList.add("out");
        setTimeout(() => {
            index = (index + 1) % ROLES.length;
            role.textContent = ROLES[index];
            role.classList.remove("out");
        }, ROLE_FADE);
    }, ROLE_INTERVAL);
}

document.addEventListener("DOMContentLoaded", () => {
    setupNavigation();
    setupReveal();
    setupRoleRotator();
});