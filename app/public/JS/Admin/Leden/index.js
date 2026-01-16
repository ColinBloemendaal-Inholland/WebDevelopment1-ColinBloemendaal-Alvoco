$(document).ready(function () {
    // Load datatables
    let ledenTable = $('#ledenTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        info: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        ajax: {
            url: '/api/leden',
            type: 'POST',
            data: function (d) {
                d.name = $('#searchNameOrEmail').val();
                d.adress = $('#searchAdress').val();
                d.role = $('#searchRole').val() || [];
                d.phone = $('#searchPhone').val();
                d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
            },
            dataSrc: 'data',
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        language: {
            zeroRecords: "Geen leden gevonden die voldoen aan je zoekopdracht",
            emptyTable: "Er zijn nog geen leden toegevoegd aan de database.",
            info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
        },
        columns: [
            { data: 'fullname', title: 'Naam', render: $.fn.dataTable.render.text() },
            { data: 'email', title: 'Email', render: $.fn.dataTable.render.text() },
            { data: 'phone', title: 'Telefoon', render: $.fn.dataTable.render.text() },
            { data: 'adres', title: 'Adres', render: $.fn.dataTable.render.text() },
            {
                data: null,
                title: 'Acties',
                orderable: false,
                render: function (data, type, row) {
                    let deletedAt;
                    if (row['deleted_at'] !== null) {
                        deletedAt = `
                            <form method="POST" action="/admin/leden/${row.id}/force" class="d-inline force-delete-form">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-sm btn-danger force-delete-link me-1"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        `;
                    } else {
                        deletedAt = `
                            <form method="POST" action="/admin/leden/${row.id}" class="d-inline delete-form">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        `;
                    }
                    return `
                        <a href="/admin/leden/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                        <a href="/admin/leden/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                    ` + deletedAt;
                },
            }
        ],
        dom: '<"top">rt<"bottom"lp><"clear">'
    });

    let reloadTimeout;
    function timeout() {
        clearTimeout(reloadTimeout);
        reloadTimeout = setTimeout(function () {
            ledenTable.ajax.reload();
        }, 1000);
    };

    // Text inputs: reload after 1 second of inactivity
    $('#searchNameOrEmail, #searchAdress, #searchPhone').on('input', timeout);

    // Multi-select: reload immediately on change
    $('#searchRole, #searchTrashed').on('change', function () {
        ledenTable.ajax.reload();
    });

    // Tom select
    new TomSelect('#searchRole', {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        },
        plugins: ['remove_button']
    });
});
