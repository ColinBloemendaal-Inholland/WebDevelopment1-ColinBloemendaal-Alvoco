tinymce.init({
    selector: '#mytextarea'
});

$(function () {
    new TomSelect("#Bestuursleden_id", { create: false, sortField: { field: "text", direction: "asc" } });
});
