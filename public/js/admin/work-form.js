document.addEventListener("DOMContentLoaded", () => {
    const input = document.querySelector("#work-image");
    const preview = document.querySelector("#work-image-preview");
    if (!input || !preview) return;

    let previewUrl = null;
    input.addEventListener("change", () => {
        const file = input.files?.[0];
        if (!file) return;

        if (previewUrl) URL.revokeObjectURL(previewUrl);
        previewUrl = URL.createObjectURL(file);
        preview.src = previewUrl;
        preview.hidden = false;
    });
});