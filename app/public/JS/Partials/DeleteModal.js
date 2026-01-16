$(document).ready(function () {
    // Delete modal logic
    let formToSubmit = null;
    // Soft delete
    $(document).on('click', '.delete-link', function (e) {
        e.preventDefault();
        formToSubmit = $(this).closest('form')[0];
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        $('#confirmDeleteBtn').off('click').on('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
                formToSubmit = null;
            }
        });
        modal.show();
    });
});
