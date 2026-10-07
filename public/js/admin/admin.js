const seedWorks = [
    { id: 1, t: "Tutor Booking App", c: "UI/UX Design", d: "A modern tutoring platform with a clean and intuitive booking experience for students and tutors.", tools: ["Figma", "UI/UX", "Prototyping"], f: 1, g: 0, link: "" },
    { id: 2, t: "Movie Trailers Platform", c: "UI/UX Design", d: "A cinematic trailer discovery experience.", tools: ["Figma", "UI/UX", "Prototyping"], f: 1, g: 1, link: "" },
    { id: 3, t: "Penong Management System", c: "Web Development", d: "A full-stack inventory and order management system for all Penong branches with role-based access.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 2, link: "" },
    { id: 4, t: "AgentHub", c: "Web Development", d: "An agent management platform.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 3, link: "" },
    { id: 5, t: "Aizap Creative Website", c: "Web Development", d: "AI-powered content for businesses.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 4, link: "" },
    { id: 6, t: "E-Commerce Platform", c: "Web Development", d: "An online store with cart and checkout.", tools: ["Laravel", "PHP", "MySQL"], f: 1, g: 5, link: "" }
];
const WORKS_KEY = "ivan_works_v1";
let currentImage = "";
let toastTimer;

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

function saveWorks(works) {
    try {
        localStorage.setItem(WORKS_KEY, JSON.stringify(works));
        return true;
    } catch {
        showToast("Browser storage is full. Try a smaller image.");
        return false;
    }
}

function escapeHtml(value) {
    return String(value).replace(/[&<>"']/g, (character) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[character]);
}

function imageMarkup(work) {
    if (work.img && (/^https?:\/\//i.test(work.img) || /^data:image\/(?:png|jpeg|webp|gif);base64,/i.test(work.img))) {
        return `<img class="admin-photo" src="${escapeHtml(work.img)}" alt="" loading="lazy">`;
    }
    return `<div class="admin-thumb tone-${Number(work.g) % 6}"><span>${escapeHtml(work.t.slice(0, 2).toUpperCase())}</span></div>`;
}

document.addEventListener("DOMContentLoaded", () => {
    const list = document.querySelector("#admin-list");
    const modal = document.querySelector("#work-modal");
    const form = document.querySelector("#work-form");
    const fields = {
        id: document.querySelector("#work-id"),
        title: document.querySelector("#project-title"),
        category: document.querySelector("#category"),
        description: document.querySelector("#description"),
        image: document.querySelector("#image-file"),
        tools: document.querySelector("#tools"),
        link: document.querySelector("#project-link"),
        featured: document.querySelector("#featured-toggle")
    };
    const preview = document.querySelector("#upload-preview");

    function showToast(message) {
        const toast = document.querySelector("#admin-toast");
        if (!toast) return;
        toast.textContent = message;
        toast.classList.add("show");
        window.clearTimeout(toastTimer);
        toastTimer = window.setTimeout(() => toast.classList.remove("show"), 2200);
    }

    function render() {
        const works = getWorks();
        document.querySelector("#admin-count").textContent = `${works.length} works`;
        list.innerHTML = works.map((work) => {
            const badgeClass = work.c === "UI/UX Design" ? "ui" : "web";
            return `<tr><td>${imageMarkup(work)}</td><td>${escapeHtml(work.t)}</td><td><span class="admin-badge ${badgeClass}">${escapeHtml(work.c)}</span></td><td class="admin-tools">${work.tools.map(escapeHtml).join(", ")}</td><td><button class="switch" type="button" data-action="feature" data-id="${escapeHtml(work.id)}" aria-pressed="${work.f ? "true" : "false"}" aria-label="${work.f ? "Remove from" : "Add to"} featured projects"></button></td><td><div class="admin-actions"><button type="button" data-action="edit" data-id="${escapeHtml(work.id)}" aria-label="Edit ${escapeHtml(work.t)}" title="Edit">✎</button><button class="delete" type="button" data-action="delete" data-id="${escapeHtml(work.id)}" aria-label="Delete ${escapeHtml(work.t)}" title="Delete">×</button></div></td></tr>`;
        }).join("");
    }

    function resetForm() {
        form.reset();
        fields.id.value = "";
        currentImage = "";
        fields.featured.setAttribute("aria-pressed", "true");
        preview.textContent = "Click to upload or drag and drop\nPNG, JPG (max 5MB)";
        document.querySelector("#modal-title").textContent = "Add Work";
        document.querySelector("#modal-description").textContent = "Fill in the details to add a new project.";
        document.querySelector("#save-work").textContent = "Add Work";
    }

    function closeModal() {
        modal.classList.remove("open");
        modal.setAttribute("aria-hidden", "true");
        document.body.classList.remove("modal-open");
    }

    function openModal(work = null) {
        resetForm();
        if (work) {
            fields.id.value = work.id;
            fields.title.value = work.t;
            fields.category.value = work.c;
            fields.description.value = work.d;
            fields.tools.value = work.tools.join(", ");
            fields.link.value = work.link || "";
            fields.featured.setAttribute("aria-pressed", work.f ? "true" : "false");
            currentImage = work.img || "";
            if (currentImage) preview.innerHTML = `<img class="upload-preview-image" src="${escapeHtml(currentImage)}" alt="Current project preview">`;
            document.querySelector("#modal-title").textContent = "Edit Work";
            document.querySelector("#modal-description").textContent = "Update the project details.";
            document.querySelector("#save-work").textContent = "Save Changes";
        }
        modal.classList.add("open");
        modal.setAttribute("aria-hidden", "false");
        document.body.classList.add("modal-open");
        fields.title.focus();
    }

    document.querySelector("#add-work").addEventListener("click", () => openModal());
    document.querySelector("#close-modal").addEventListener("click", closeModal);
    document.querySelector("#cancel-modal").addEventListener("click", closeModal);
    modal.addEventListener("click", (event) => { if (event.target === modal) closeModal(); });
    document.addEventListener("keydown", (event) => { if (event.key === "Escape" && modal.classList.contains("open")) closeModal(); });

    fields.featured.addEventListener("click", () => {
        const enabled = fields.featured.getAttribute("aria-pressed") !== "true";
        fields.featured.setAttribute("aria-pressed", String(enabled));
    });

    fields.image.addEventListener("change", () => {
        const file = fields.image.files[0];
        if (!file) return;
        if (!file.type.startsWith("image/")) {
            showToast("Choose an image file.");
            fields.image.value = "";
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            showToast("Image must be 5MB or smaller.");
            fields.image.value = "";
            return;
        }
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            currentImage = String(reader.result);
            preview.innerHTML = `<img class="upload-preview-image" src="${escapeHtml(currentImage)}" alt="Selected project preview">`;
        });
        reader.readAsDataURL(file);
    });

    list.addEventListener("click", (event) => {
        const button = event.target.closest("button[data-action]");
        if (!button) return;
        const works = getWorks();
        const work = works.find((item) => String(item.id) === button.dataset.id);
        if (!work) return;

        if (button.dataset.action === "edit") openModal(work);
        if (button.dataset.action === "delete" && window.confirm(`Delete ${work.t}?`)) {
            if (saveWorks(works.filter((item) => String(item.id) !== button.dataset.id))) {
                render();
                showToast("Work deleted.");
            }
        }
        if (button.dataset.action === "feature") {
            work.f = work.f ? 0 : 1;
            if (saveWorks(works)) {
                render();
                showToast(work.f ? "Featured on home." : "Removed from home.");
            }
        }
    });

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const works = getWorks();
        const work = {
            id: fields.id.value || Date.now(),
            t: fields.title.value.trim(),
            c: fields.category.value,
            d: fields.description.value.trim(),
            tools: fields.tools.value.split(",").map((tool) => tool.trim()).filter(Boolean),
            f: fields.featured.getAttribute("aria-pressed") === "true" ? 1 : 0,
            g: Number(fields.id.value ? works.find((item) => String(item.id) === fields.id.value)?.g : works.length % 6) || 0,
            link: fields.link.value.trim(),
            img: currentImage
        };
        const index = works.findIndex((item) => String(item.id) === String(work.id));
        if (index >= 0) works[index] = work;
        else works.push(work);

        if (!saveWorks(works)) return;
        closeModal();
        render();
        showToast(index >= 0 ? "Changes saved." : "Work added.");
    });

    render();
});
