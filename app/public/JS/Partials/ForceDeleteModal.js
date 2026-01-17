$(document).ready(function () {
    let formToSubmit = null;
    const $entityLabel = $('#forceDeleteModalEntity');
    const defaultEntity = $entityLabel.text();
    // Force delete
    $(document).on('click', '.force-delete-link', function (e) {
        e.preventDefault();
        formToSubmit = $(this).closest('form')[0];
        const entityName = $(this).data('entity') || defaultEntity;
        $entityLabel.text(entityName);
        const modal = new bootstrap.Modal(document.getElementById('forceDeleteModal'));
        $('#confirmForceDeleteBtn').off('click').on('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
                formToSubmit = null;
            }
        });
        modal.show();
    });
});
