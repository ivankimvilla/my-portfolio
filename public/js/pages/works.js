const seedWorks = [
    { id: 1, t: "Tutor Booking App", c: "UI/UX Design", d: "A modern tutoring platform with a clean and intuitive booking experience for students and tutors.", tools: ["Figma", "UI/UX", "Prototyping"], f: 1, g: 0, link: "" },
    { id: 2, t: "Movie Trailers Platform", c: "UI/UX Design", d: "A cinematic trailer discovery experience.", tools: ["Figma", "UI/UX", "Prototyping"], f: 1, g: 1, link: "" },
    { id: 3, t: "Penong Management System", c: "Web Development", d: "A full-stack inventory and order management system for all Penong branches with role-based access.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 2, link: "" },
    { id: 4, t: "AgentHub", c: "Web Development", d: "An agent management platform.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 3, link: "" },
    { id: 5, t: "Aizap Creative Website", c: "Web Development", d: "AI-powered content for businesses.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 4, link: "" },
    { id: 6, t: "E-Commerce Platform", c: "Web Development", d: "An online store with cart and checkout.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 5, link: "" },
    { id: 7, t: "Dashboard UI", c: "UI/UX Design", d: "A clean admin dashboard concept.", tools: ["Figma", "UI/UX"], f: 1, g: 0, link: "" },
    { id: 8, t: "Landing Page", c: "UI/UX Design", d: "A responsive landing page concept.", tools: ["Figma", "Prototyping"], f: 1, g: 1, link: "" }
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

function imageMarkup(work) {
    if (work.img && (/^https?:\/\//i.test(work.img) || /^data:image\/(?:png|jpeg|webp|gif);base64,/i.test(work.img))) {
        return `<div class="project-thumb"><img class="project-photo" src="${escapeHtml(work.img)}" alt="" loading="lazy"></div>`;
    }
    return `<div class="project-thumb tone-${Number(work.g) % 6}"><div class="mock-window"><b></b><i></i><i></i><i></i></div></div>`;
}

function projectCard(work) {
    const href = /^https?:\/\//i.test(work.link) ? escapeHtml(work.link) : "#";
    const target = href !== "#" ? ' target="_blank" rel="noopener noreferrer"' : "";
    return `<article class="work-card motion-in">${imageMarkup(work)}<div class="work-card-copy"><small class="work-category">${escapeHtml(work.c === "Web Development" ? "Web Application" : "UI/UX Concept")}</small><h3>${escapeHtml(work.t)}</h3><p class="work-description">${escapeHtml(work.d)}</p><div class="tag-list"><span class="tag-label">Tech:</span>${work.tools.map((tool) => `<span>${escapeHtml(tool)}</span>`).join("")}</div><a class="project-link" href="${href}"${target}>View Project <span aria-hidden="true">→</span></a></div></article>`;
}

function observeMotion() {
    const targets = document.querySelectorAll(".motion-in:not(.is-visible)");
    const observer = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
    }), { threshold: 0.08 });
    targets.forEach((target) => observer.observe(target));
}

document.addEventListener("DOMContentLoaded", () => {
    const grid = document.querySelector("#works-grid");
    if (!grid) return;
    let activeFilter = "All";

    function renderWorks() {
        const works = getWorks();
        const categories = activeFilter === "All" ? ["Web Development", "UI/UX Design"] : [activeFilter];
        const visibleWorks = works.filter((work) => categories.includes(work.c));
        grid.innerHTML = categories.map((category) => {
            const categoryWorks = works.filter((work) => work.c === category);
            if (!categoryWorks.length) return "";
            const isDesign = category === "UI/UX Design";
            const title = isDesign ? "UI/UX Design Samples" : "Featured Projects";
            const description = isDesign ? "Some design concepts and interface layouts I created." : "Selected works that showcase my development and design skills.";
            return `<section class="work-group ${isDesign ? "work-group--design" : "work-group--development"}"><header class="work-group-heading"><h2>${title}</h2><p>${description}</p></header><div class="works-cards">${categoryWorks.map(projectCard).join("")}</div></section>`;
        }).join("");
        observeMotion();

        const count = document.querySelector("#work-count");
        if (count) count.textContent = String(visibleWorks.length).padStart(2, "0");
        document.querySelectorAll(".filter-pill").forEach((button) => {
            const category = button.dataset.filter;
            const total = category === "All" ? works.length : works.filter((work) => work.c === category).length;
            const countLabel = button.querySelector("em");
            if (countLabel) countLabel.textContent = total;
        });
    }

    document.querySelectorAll(".filter-pill").forEach((button) => button.addEventListener("click", () => {
        activeFilter = button.dataset.filter;
        document.querySelectorAll(".filter-pill").forEach((item) => {
            const active = item === button;
            item.classList.toggle("active", active);
            item.setAttribute("aria-pressed", String(active));
        });
        renderWorks();
    }));

    const nav = document.querySelector(".site-nav");
    const toggle = document.querySelector(".nav-toggle");
    toggle?.addEventListener("click", () => {
        const open = nav.classList.toggle("menu-open");
        toggle.setAttribute("aria-expanded", String(open));
    });
    renderWorks();
});
