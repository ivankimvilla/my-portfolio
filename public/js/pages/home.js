const seedWorks = [
    { id: 1, t: "Tutor Booking App", c: "UI/UX Design", d: "A modern tutoring platform with a clean and intuitive booking experience for students and tutors.", tools: ["Figma", "UI/UX", "Prototyping"], f: 1, g: 0, link: "" },
    { id: 2, t: "Movie Trailers Platform", c: "UI/UX Design", d: "A cinematic trailer discovery experience.", tools: ["Figma", "UI/UX", "Prototyping"], f: 1, g: 1, link: "" },
    { id: 3, t: "Penong Management System", c: "Web Development", d: "A full-stack inventory and order management system for all Penong branches with role-based access.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 2, link: "" },
    { id: 4, t: "AgentHub", c: "Web Development", d: "An agent management platform.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 3, link: "" },
    { id: 5, t: "Aizap Creative Website", c: "Web Development", d: "AI-powered content for businesses.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 4, link: "" },
    { id: 6, t: "E-Commerce Platform", c: "Web Development", d: "An online store with cart and checkout.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 5, link: "" }
];
const WORKS_KEY = "ivan_works_v1";

function normalizeWorks(works) {
    return works.map((work, index) => ({
        id: work.id ?? Date.now() + index,
        t: work.t ?? work.title ?? "Untitled project",
        c: work.c ?? (work.category === "uiux" ? "UI/UX Design" : work.category === "web" ? "Web Development" : work.category ?? "UI/UX Design"),
        d: work.d ?? work.description ?? "",
        tools: Array.isArray(work.tools) ? work.tools : String(work.tools ?? "").split(",").map((tool) => tool.trim()).filter(Boolean),
        f: Number(work.f ?? work.featured ?? 0),
        g: Number(work.g ?? index % 6),
        link: work.link ?? "",
        img: work.img ?? work.image ?? ""
    }));
}

function getWorks() {
    try {
        const saved = localStorage.getItem(WORKS_KEY);
        if (saved) return normalizeWorks(JSON.parse(saved));
        const previous = localStorage.getItem("ivanProjects");
        return previous ? normalizeWorks(JSON.parse(previous)) : seedWorks;
    } catch {
        return seedWorks;
    }
}

function escapeHtml(value) {
    return String(value).replace(/[&<>"']/g, (character) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[character]);
}

function workCard(work) {
    const title = escapeHtml(work.t);
    const link = "/works";
    const artwork = work.img
        ? `<div class="project-thumb" style="background-image:linear-gradient(#0a161014,#0a161014),url('${escapeHtml(work.img)}')"></div>`
        : `<div class="project-thumb tone-${Number(work.g) % 6}"><div class="mock-window"><b></b><i></i><i></i><i></i></div></div>`;
    return `<a class="work-card motion-in" href="${link}">${artwork}<h3>${title}<span class="work-arrow" aria-hidden="true">→</span></h3><small class="work-category">${escapeHtml(work.c)}</small><p>${escapeHtml(work.d)}</p><div class="tag-list">${work.tools.map((tool) => `<span>${escapeHtml(tool)}</span>`).join("")}</div></a>`;
}

function setupNavigation() {
    const nav = document.querySelector(".site-nav");
    const toggle = document.querySelector(".nav-toggle");
    toggle?.addEventListener("click", () => {
        const open = nav.classList.toggle("menu-open");
        toggle.setAttribute("aria-expanded", String(open));
        toggle.setAttribute("aria-label", open ? "Close navigation" : "Open navigation");
    });
}

function setupMotion() {
    const targets = document.querySelectorAll(".service-card, .home-work-grid .work-card, .skills-panel, .about-callout");
    targets.forEach((target) => target.classList.add("motion-in"));
    const observer = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
        }
    }), { threshold: 0.08 });
    targets.forEach((target) => observer.observe(target));
}

function setupCounters() {
    const counters = document.querySelectorAll("[data-count]");
    const observer = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const element = entry.target;
        const target = Number(element.dataset.count);
        const suffix = element.dataset.suffix ?? "";
        const started = performance.now();
        const tick = (now) => {
            const progress = Math.min((now - started) / 1100, 1);
            element.textContent = `${Math.round(target * (1 - Math.pow(1 - progress, 3)))}${suffix}`;
            if (progress < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
        observer.unobserve(element);
    }), { threshold: 0.5 });
    counters.forEach((counter) => observer.observe(counter));
}

document.addEventListener("DOMContentLoaded", () => {
    const grid = document.querySelector("#featured-grid");
    if (!grid) return;
    grid.innerHTML = getWorks().filter((work) => work.f).slice(0, 3).map(workCard).join("");
    setupNavigation();
    setupMotion();
    setupCounters();

    const roles = ["Full-Stack Development", "AI Integration", "AI Agent Pipelines", "Prompt Engineering"];
    const role = document.querySelector("#role-text");
    if (role) {
        let index = 0;
        window.setInterval(() => {
            role.classList.add("out");
            window.setTimeout(() => {
                index = (index + 1) % roles.length;
                role.textContent = roles[index];
                role.classList.remove("out");
            }, 300);
        }, 2800);
    }
});
