document.addEventListener("DOMContentLoaded", function () {
    new TomSelect("#Leden_id", {
        create: false,
        sortField: { field: "text", direction: "asc" },
        plugins: ["remove_button"],
    });
    new TomSelect("#team_id", {
        create: false,
        sortField: { field: "text", direction: "asc" },
        plugins: ["remove_button"],
    });
});
